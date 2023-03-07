<template>
    <h1 class="text-h5 text-center mt-4">Todo App 💚</h1>
    <Todo :todos="todos"/>
</template>

<script>
import { mapState } from 'vuex';
import store from '../Store/main'
import Todo from '../Components/Todo.vue'

export default{
    components:{
        Todo,
    },

    computed:{
        ... mapState(['todos'])
    },

    mounted(){
        store.dispatch('getTodos')
    }
}

</script>

<style lang="scss" scoped></style>
