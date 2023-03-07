<template>
    <div class="mx-auto" style="max-width: 50%;">
        <div class="d-flex align-items-center">
            <v-text-field v-model="todoInput" placeholder="Add todo" prepend-icon="mdi-pen" @keyup.enter="saveTodo" />
            <v-btn :loading="inputLoading" @click="saveTodo" color="green" size="x-large" append-icon="mdi-plus">
                Add Todo
            </v-btn>
        </div>

        <div class="mt-3">
            <todo-item v-for="todo in todos" :key="todo.id" :todo="todo"/>
        </div>
    </div>
</template>

<script>

import TodoItem from './TodoItem.vue'
import { mapActions } from 'vuex';

export default {
    props:{
        todos:{
            type:Array,
            required:true
        }
    },

    components:{TodoItem},

    data(){
        return {
            inputLoading:false,
            todoInput:""
        }
    },

    methods:{
        ... mapActions(['addTodo']),

        saveTodo(){
            this.inputLoading = true;

            if (!this.todoInput.trim()) {
                this.inputLoading = false;
                return ;
            }

            const todo = {
                title: this.todoInput
            }

            this.addTodo(todo);

            this.todoInput = '';
            this.inputLoading = false;
        }

    }

}
</script>

<style lang="scss" scoped></style>
