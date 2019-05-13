<style scoped>
body {
  overflow-x: hidden;
}

#sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  -webkit-transition: margin .25s ease-out;
  -moz-transition: margin .25s ease-out;
  -o-transition: margin .25s ease-out;
  transition: margin .25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
  width: 100%;
}

#page-content-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
}
</style>

<template>
<div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">#App name </div>
      <div class="list-group list-group-flush">
        <a href="/home" class="list-group-item list-group-item-action bg-light">Home</a>
        <a href="/search" class="list-group-item list-group-item-action bg-light">Search</a>
        <a href="/mylib" class="list-group-item list-group-item-action bg-light">Your library</a>
      </div>   
</div>
</template>

<script>
    export default {
        props:{
            playlists:{
                id: String,
                title: String
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }

    //sidebare css: https://github.com/BlackrockDigital/startbootstrap-simple-sidebar
</script>
