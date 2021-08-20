<template>
    <app-modal @close="close">
        <div class="the-expense-add-modal">
            <h2>Добавить расход</h2>

        </div>
    </app-modal>
</template>

<script>
export default {
    name: "TheExpenseAddModal",
    methods: {
        close(){
            this.$emit('close');
        }
    }
}
</script>

<style lang="scss" scoped>
    .the-expense-add-modal{
        @include neumorphic-in;
        background: $bg-color;
        border-radius: $border-radius;
    }

    @mixin the-expense-add-modal-sizes($pageSize){
        .the-expense-add-modal{
            width: convertByVw($pageSize, 375px);
            height: convertByVw($pageSize, 500px);
            padding: convertByVw($pageSize, $main-padding);
        }
    }

    @include the-expense-add-modal-sizes($xlg-max);

    @media (max-width: $xlg){
        @include the-expense-add-modal-sizes($xlg);
    }

    @media (max-width: $lg){
        @include the-expense-add-modal-sizes($lg);
    }

    @media (max-width: $md){
        @include the-expense-add-modal-sizes($md);
    }

    @media (max-width: $tablet-horizontal){
        @include the-expense-add-modal-sizes($tablet-horizontal);
    }

    @media (max-width: $sm){
        @include the-expense-add-modal-sizes($sm);
    }

    @media (max-width: $xs){
        @include the-expense-add-modal-sizes($xs);
    }

    @media (max-width: $xs-mid){
        @include the-expense-add-modal-sizes($xs-mid);
    }
</style>
