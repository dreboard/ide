
<template>
  <div id="cli-form">
    <form>
      <label>Employee name</label>
      <input v-model="employee.name" type="text" />
      <label>Employee Email</label>
      <input v-model="employee.email" type="text" />
      <button>Add Employee</button>
    </form>
  </div>
</template>

<script>
  export default {
    name: 'cli-view',
  }
</script>

<style scoped></style>