<template>
    <div>
        <span v-for="tag in list" :key="`tag-${tag.id}`" class="badge bg-primary me-2">
            {{ tag.name }}
        </span>
    </div>
</template>

<script>
export default {
    name: 'Tags',
    props: {
        list: Array,
    }
}
</script>

<style>

</style>