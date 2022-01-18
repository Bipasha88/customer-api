<template>
    <div>
        <h2>All Customers</h2>
        <br>
        <table class="table" id="datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Company</th>
                <th>City</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in customers" :key="item.id">
                <td>{{item.id}}</td>
                <td>{{item.first_name}} {{item.last_name}}</td>
                <td>{{item.company}}</td>
                <td>{{item.city}}</td>
                <td>{{item.latitude}}</td>
                <td>{{item.longitude}}</td>
                <td><router-link :to="{ path: '/'+ item.id}"  class="">Detail</router-link></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import "jquery/dist/jquery.min.js";
import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";

export default {
    mounted() {
        fetch("http://localhost:8000/api/customer/")
            .then((response) => response.json())
            .then((data) => {
                this.customers = data;
                setTimeout(() => {
                    $("#datatable").DataTable({
                        lengthMenu: [
                            [5,10, 25, 50, -1],
                            [5,10, 25, 50, "All"],
                        ],
                        pageLength: 10,
                    });
                });
            });
    },
    data: function() {
        return {
            customers:[]

        }
    },
}
</script>
