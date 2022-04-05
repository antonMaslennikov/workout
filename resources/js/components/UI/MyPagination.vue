<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
<!--            <li class="page-item">-->
<!--                <a class="page-link" href="#" aria-label="Previous">-->
<!--                    <span aria-hidden="true">&laquo;</span>-->
<!--                </a>-->
<!--            </li>-->
            <li
                v-for="pageNumber in totalPages"
                :key="page"
                class="page-item"
                :class="{
                 'active' : page === pageNumber
                 }"
                @click="changePage(pageNumber)"><a class="page-link" href="#">{{ pageNumber }}</a></li>
<!--            <li class="page-item">-->
<!--                <a class="page-link" href="#" aria-label="Next">-->
<!--                    <span aria-hidden="true">&raquo;</span>-->
<!--                </a>-->
<!--            </li>-->
        </ul>
    </nav>
<!--  <div class="page__wrapper">-->
<!--    <div-->
<!--        v-for="pageNumber in totalPages"-->
<!--        :key="page"-->
<!--        class="page"-->
<!--        :class="{-->
<!--            'current-page' : page === pageNumber-->
<!--          }"-->
<!--        @click="changePage(pageNumber)"-->
<!--    >{{ pageNumber }}</div>-->
<!--  </div>-->
</template>

<script>
export default {
  name: "my-pagination",
  props: {
    page: {
      type: Number,
      default: 1
    },
    totalPages: Number
  },
  methods: {
    changePage(number) {
      this.$emit('setPage', number);
      this.$emit('update:page', number);
    }
  },
}
</script>

<style scoped>
  .page__wrapper {
    display: flex;
    margin-top: 15px;
  }
  .page {
    border:1px solid black;
    padding: 6px 10px;
    cursor: pointer;
    margin-right: 5px;
  }
  .current-page {
    border:2px solid teal;
  }
</style>
