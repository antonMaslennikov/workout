<template>
    <div :class="dayClass"
         @click="$emit('showDayModal', day.day)"
    >
        <span class="day">{{ day.day }}</span>
        <div class="trainings-counter" v-if="day.trainings > 0">{{ day.trainings }}</div>
    </div>
</template>

<script>
export default {
    name: "Day",
    props: {
        day: {
            type: Object,
            required: true
        }
    },
    computed: {
        dayClass() {
            return this.day.year == new Date().getFullYear() && this.day.month == new Date().getMonth() + 1 && this.day.day == new Date().getDate() ? 'currentDay' : ''
        }
    }
}
</script>

<style scoped>
.day {
    font-size: 30px;
    font-style: italic;
    font-weight: bold;
}

.trainings-counter {
    background: #db8157;
    color: white;
    width: 30px;
    height: 30px;
    line-height: 30px;
    border-radius: 50%;
    text-align: center;
}

@media screen and (max-width: 590px) {
    .day {
        font-size: 20px;
    }
}
@media screen and (max-width: 460px) {
    .day {
        font-size: 15px;
    }
    .trainings-counter {
        width: 20px;
        height: 20px;
        line-height: 20px;
    }
}
@media screen and (max-width: 400px) {
    .day {
        font-size: 12px;
    }
}
</style>
