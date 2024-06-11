<template id="vueapp">
	<user-name name="Flavio"></user-name>
<template>

<script>
Vue.component('user-name', {
	props: ['name'],
	template: '<p>Hi {{ name }}</p>'
})
</script>