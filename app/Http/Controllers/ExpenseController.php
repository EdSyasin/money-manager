<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ExpenseController extends Controller
{
    public function store(Request $request){
        $expense = new Expense;

        $expense->user_id = Auth::id();
        $expense->amount = $request->input('amount');
        $expense->description = $request->input('description');
        if($request->has('category_id')){
            $expense->category_id = $request->input('category_id');
        }


        $expense->save();
        return response()->json($expense, 201);
    }

    public function get(Request $request){

    }

    public function getByUser(Request $request, $userId){
        $this->validate($request, [
            'from' => 'date_format:Y-m-d',
            'to' => 'date_format:Y-m-d',
        ]);
        $dateFrom = $request->input('from');
        $dateTo = $request->input('to');
        $itemsPerPage = $request->has('itemsPerPage') ? $request->input('itemsPerPage') : 15;

        $expensesQuery = Expense::where('user_id', $userId)
            ->when($dateFrom, function($query, $dateFrom){
                return $query->where('spent_at', '>=', $dateFrom);
            })
            ->when($dateTo, function($query, $dateTo){
                return $query->where('spent_at', '<=', $dateTo);
            });

        if($request->has('page')){
            $expenses = $expensesQuery->paginate($itemsPerPage);
            $result = [
                'expenses' => $expenses->items(),
                'total' => $expenses->total()
            ];
        } else {
            $expenses = $expensesQuery->get();
            $result = [
                'expenses' => $expenses,
                'total' => Count($expenses)
            ];
        }
        return response()->json($result);
    }
}
