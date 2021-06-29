<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ExpenseController extends Controller
{
    public function store(Request $request){
        $expense = new Expense;

        $expense->user_id = $request->input('userId');
        $expense->amount = $request->input('amount');
        $expense->description = $request->input('description');
        if($request->has('category_id')){
            $expense->category_id = $request->input('category_id');
        }


        $expense->save();
        return response()->json($expense, 201);
    }
}
