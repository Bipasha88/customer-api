<template>
    <div>
        <h3 class="text-center">Customer Information</h3>
        <div class="row">
            <div class="col-md-6">
                <p>First Name:  {{customer.first_name}}</p>
                <p>Last Name:   {{customer.last_name}}</p>
                <p>Email:   {{customer.email}}</p>
                <p>Gender:   {{customer.gender}}</p>
                <p>Company:   {{customer.company}}</p>
                <p>City:   {{customer.city}}</p>
                <p>Latitude:   {{customer.latitude}}</p>
                <p>Longitude:   {{customer.longitude}}</p>
                <p>Title:   {{customer.title}}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            customer: {}
        }
    },
    mounted() {
        axios
            .get(`http://localhost:8000/api/customer/${this.$route.params.id}`)
            .then((response) => {
                this.customer = response.data;
            });
        console.log("Single Customer");
    },
}
</script>
