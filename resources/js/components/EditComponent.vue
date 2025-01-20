<template>
    <div v-if="person" class="flex flex-col gap-4 items-center">
        <input type="text" v-model="person.name" placeholder="name">
        <input type="text" v-model="person.email" placeholder="email">
        <input type="hidden" v-model="person.id">
        <select v-model="person.country_id">
            <option value='null' disabled>--Select a country</option>
            <option :value="country.id" v-for="country in countries">
                {{country.name}}
            </option>
        </select>

        <select v-model="person.rol">
            <option value="" disabled>--Select a role</option>
            <option v-for="role in roles" :value="role.title">
                {{role.title}}
            </option>
        </select>
        <button class="addTransitionEffect border rounded border-1 px-4 py-1 hover:bg-green-400 hover:text-white" @click.prevent="editTheUser(person.id)">Edit</button>
    </div>
</template>

<script setup>
import {ref, onMounted} from 'vue'
import {useRoute, useRouter} from 'vue-router'

const route = useRoute();
const router = useRouter();
const person = ref({});
const countries = ref([]);
const roles = ref([]);

function getPersonsDetails(){
    axios.get(`/api/getUser/${route.params.id}`).then(res =>{
        console.log(res.data.user);
        person.value = res.data.user;
        person.value.country = res.data.usersCountry;

        countries.value = res.data.countries;
        roles.value = res.data.roles;
    })
}
function editTheUser(id){
    axios.post(`/api/editUser/${id}`, {
        id:person.value.id,
        name:person.value.name,
        email:person.value.email,
        country_id:person.value.country_id,
        rol:person.value.rol,
    } ).then(res =>{
        console.log(res.data.message);
        if(res.data.message === 'Edited successfully!'){
            router.push({name:'All'})
        }
    })
}
onMounted(()=>{
    getPersonsDetails();
})

</script>

<style scoped>
input{
    outline:none;
    border-bottom: 1px solid;
}
select{
    outline:none;
    border:1px solid green;
    border-radius: 5px;
    padding:3px;
}
.addTransitionEffect{
    transition:0.3s ease-in-out;
}
</style>
