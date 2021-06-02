<template>
    <div>
        <details v-for="(sub_catalog) in this.car.catalog">
            <summary>{{ sub_catalog.name }}</summary>
            <p v-for="(item) in sub_catalog.data">{{ item.name }}</p>
        </details>
    </div>

</template>

<script>
  export default {
    name: "CatalogPageComponent",
    props: {
      car: {
        // type: Array,
      }
    },
    mounted() {
      console.log(this.car);
    }
  }
</script>

<style scoped>

</style>
