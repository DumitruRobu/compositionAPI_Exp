<template>
    <div class="theDiv">
        <input @input="searchUser" v-model="searchQuery" type="text" placeholder="Search..." class="theSearchBox outline-none">
    </div>

    <table class="theTable">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Country</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="person in people">
            <td>{{ person.id }}</td>
            <td>{{ person.name }}</td>
            <td>{{ person.email }}</td>
            <td>{{ person.rol ? person.rol : 'Role not indicated!' }}</td>
            <td>{{ person.country ? person.country.name : 'Country not indicated' }}</td>
            <td class="hover:text-white hover:bg-gray-500">
                <router-link class="block w-full h-full text-center" :to="{name:'EditPerson', params:{id:person.id}}">
                    Edit
                </router-link>
            </td>
            <td class="hover:text-white hover:bg-gray-500">
                <button class="block w-full h-full text-center" @click.prevent="deleteUser(person.id)">Delete</button>
            </td>
        </tr>
        </tbody>

    </table>
</template>

<script setup>
import {ref, onMounted} from 'vue'

const people = ref({});
const searchQuery = ref('');

function getPeople(url='/api/getUsers') {
    axios.get(url, {params:{searchCriterion:searchQuery.value}}).then(res => {
        people.value = res.data.users;
        console.log(res.data.users);
    })
}

function deleteUser(id) {
    axios.delete(`/api/deleteUser/${id}`).then(res => {
        getPeople();
        console.log(res.data.message);
    })
}

function searchUser(){
    getPeople();
}

onMounted(() => {
    getPeople();
})
</script>

<style lang="scss" scoped>
.theTable {
    width: 80%;
    margin: 50px auto;
    border: 1px solid;

    td, th {
        padding: 5px;
        border: 1px solid;
    }
}

.theDiv{
    display:flex;
    justify-content: flex-end;
    .theSearchBox{
        border-bottom: 1px solid;
        margin-right:10px;
        background-image: url('search.png');
        background-repeat: no-repeat;
        width:200px;
        background-position:1px 10px;
        padding:10px 40px;
        background-size:30px 30px;
    }
}
</style>
