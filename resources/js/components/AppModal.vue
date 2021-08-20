<template>
    <div class="app-modal">
        <div class="app-modal__overlay" @click="close"></div>
        <div class="app-modal__content">
            <slot/>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppModal",
    methods: {
        close(){
            this.$emit('close');
        }
    },
    mounted(){
        document.body.append(this.$el);
    }
}
</script>

<style lang="scss" scoped>
    .app-modal{
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: scroll;

        &__overlay{
            position: fixed;
            z-index: 1001;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: $bg-color;
            opacity: 0.8;
        }

        &__content{
            position: relative;
            z-index: 1002;
        }
    }

    @mixin app-modal-sizes($pageSize){
        .app-modal{

        }
    }

    @include app-modal-sizes($xlg-max);

    @media (max-width: $xlg){
        @include app-modal-sizes($xlg);
    }

    @media (max-width: $lg){
        @include app-modal-sizes($lg);
    }

    @media (max-width: $md){
        @include app-modal-sizes($md);
    }

    @media (max-width: $tablet-horizontal){
        @include app-modal-sizes($tablet-horizontal);
    }

    @media (max-width: $sm){
        @include app-modal-sizes($sm);
    }

    @media (max-width: $xs){
        @include app-modal-sizes($xs);
    }

    @media (max-width: $xs-mid){
        @include app-modal-sizes($xs-mid);
    }
</style>
