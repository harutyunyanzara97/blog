<template>
  <div id="material-kit">
    <div :class="{ 'nav-open': NavbarStore.showNavbar }">
      <router-view name="header" />
      <div>
        <router-view />
<!--          <example-component></example-component>-->
      </div>
      <router-view name="footer" />
    </div>
  </div>
</template>

