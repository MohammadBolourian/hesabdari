<template>

    <div class="container mx-6">
        <div class="modal-backdrop">
            <div class="modal">
                <header class="modal-header">
                    <slot name="header">
                     افزایش هدف
                    </slot>
                    <button
                        type="button"
                        class="btn-close"
                        @click="close"
                    >
                        x
                    </button>
                </header>

              <input type="text" placeholder="money" name="money">
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        name: 'Modal',
        methods: {
            close() {
                this.$emit('close');
            },
        },
    };
</script>
<style>
    .modal-backdrop {
        position: fixed;
        top: 200px;
        bottom: 200px;
        left: 200px;
        right: 200px;
        background-color: rgba(165, 165, 165, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal {
        background: #FFFFFF;
        box-shadow: 2px 2px 20px 1px;
        overflow-x: auto;
        display: flex;
        flex-direction: column;
    }

    .modal-header,
    .modal-footer {
        padding: 15px;
        display: flex;
    }

    .modal-header {
        position: relative;
        border-bottom: 1px solid #eeeeee;
        color: #4AAE9B;
        justify-content: space-between;
    }

    .modal-footer {
        border-top: 1px solid #eeeeee;
        flex-direction: column;
        justify-content: flex-end;
    }

    .modal-body {
        position: relative;
        padding: 20px 10px;
    }

    .btn-close {
        position: absolute;
        top: 0;
        right: 0;
        border: none;
        font-size: 20px;
        padding: 10px;
        cursor: pointer;
        font-weight: bold;
        color: #4AAE9B;
        background: transparent;
    }

    .btn-green {
        color: black;
        background: #4AAE9B;
        border: 1px solid #4AAE9B;
        border-radius: 2px;
    }

</style>
