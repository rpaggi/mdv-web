<template>
  <div class="loader" :class="{'lg':lg!==false, 'sm':sm!==false}"></div>
</template>

<script>
export default {
  name: "Spinner",
  props:{
    sm:{
      default: false
    },
    lg:{
      default: false
    }
  }
}
</script>

<style lang="scss">
.loader,
.loader:after {
  border-radius: 50%;
  width: 3em;
  height: 3em;
}
.loader {
  font-size: 10px;
  position: relative;
  text-indent: -9999em;
  border-top: 0.5em solid rgba(255, 255, 255, 0.2);
  border-right: 0.5em solid rgba(255, 255, 255, 0.2);
  border-bottom: 0.5em solid rgba(255, 255, 255, 0.2);
  border-left: 0.5em solid #ffffff;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation: load8 1.1s infinite linear;
  animation: load8 1.1s infinite linear;

  &.lg{
    border-top: 0.6em solid rgba(255, 255, 255, 0.2);
    border-right: 0.6em solid rgba(255, 255, 255, 0.2);
    border-bottom: 0.6em solid rgba(255, 255, 255, 0.2);
    border-left: 0.6em solid #ffffff;
    width: 5em;
    height: 5em;
  }

  &.sm{
    border-top: 0.3em solid rgba(255, 255, 255, 0.2);
    border-right: 0.3em solid rgba(255, 255, 255, 0.2);
    border-bottom: 0.3em solid rgba(255, 255, 255, 0.2);
    border-left: 0.3em solid #ffffff;
    width: 2em;
    height: 2em;
  }
}
@-webkit-keyframes load8 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes load8 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>