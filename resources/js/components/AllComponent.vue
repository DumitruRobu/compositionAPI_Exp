<template>
    <p>All content</p>
    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Country</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tr v-for="person in people">
            <td>{{person.id}}</td>
            <td>{{person.name}}</td>
            <td>{{person.email}}</td>
            <td>{{person.country ? person.country.name : 'Country not indicated'}}</td>
            <td>Edit</td>

            <td><button @click.prevent="deleteUser(person.id)">Delete</button></td>
        </tr>
    </table>
</template>

<script setup>
import {ref, onMounted} from 'vue'
const people = ref({});

function getPeople(){
    axios.get('/api/getUsers').then(res =>{
        people.value = res.data.users;
        console.log(res.data.users);
    })
}
function deleteUser(id){
    axios.delete(`/api/deleteUser/${id}`).then(res =>{
        getPeople();
        console.log(res.data.message);
    })
}
onMounted(()=>{
    getPeople();
})
</script>

<style scoped>

</style>
