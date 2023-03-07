<template>
    <v-list-item>
        <template #prepend="{ completed }">
            <v-list-item-action start>
                <v-checkbox-btn :model-value="todo.completed" @change="toggleTodo"></v-checkbox-btn>
            </v-list-item-action>
        </template>

        <v-list-item-title>{{ todo.title }}</v-list-item-title>

        <template #append>
            <v-icon color="red" icon="mdi-close" @click="deleteTodo(todo.id)" ></v-icon>
        </template>
    </v-list-item>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    props: ['todo'],
    methods: {
        ...mapActions(['deleteTodo', 'updateTodo']),
        toggleTodo() {
            let newTodo = {
                id: this.todo.id,
                completed: !this.todo.completed
            }

            this.updateTodo(newTodo);
        }
    },

}
</script>

<style lang="scss" scoped></style>
