<template>
    <ul class="timeline">

        <li class="time-label">
            <span class="bg-red bg-primary text-white">
                Сет №1
            </span>
        </li>

        <li>
            <i class="fa bi-clock bg-blue"></i>

            <div class="timeline-item">
<!--                <span class="time"><i class="fa bi bi-clock"></i> 12:05</span>-->

                <h3 class="timeline-header">Название упражнения</h3>

                <div class="timeline-body">
                    Комментарий
                </div>

                <div class="timeline-footer">
                    <a class="btn btn-success btn-sm">выполнено</a>
                </div>
            </div>
        </li>

        <li>
            <i class="fa bi bi-clock bg-gray"></i>
        </li>

    </ul>
</template>

<script>
export default {
    name: "One",
    props: {
        id: {
            type: Number,
            required: true
        }
    },
    mounted() {

    }
}
</script>

<style scoped>
.timeline {
    position: relative;
    margin: 0 0 30px 0;
    padding: 0;
    list-style: none;
}
.timeline:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #ddd;
    left: 31px;
    margin: 0;
    border-radius: 2px;
}
.timeline>li {
    position: relative;
    margin-right: 10px;
    margin-bottom: 15px;
}
.timeline>.time-label>span {
    font-weight: 600;
    padding: 5px;
    display: inline-block;
    background-color: #fff;
    border-radius: 4px;
}
.timeline>li:before, .timeline>li:after {
    content: " ";
    display: table;
}
.timeline>li>.fa, .timeline>li>.glyphicon, .timeline>li>.ion {
    width: 30px;
    height: 30px;
    font-size: 15px;
    line-height: 30px;
    position: absolute;
    color: #666;
    background: #d2d6de;
    border-radius: 50%;
    text-align: center;
    left: 18px;
    top: 0;
}
.timeline>li>.timeline-item {
    -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
    border-radius: 3px;
    margin-top: 0;
    background: #fff;
    color: #444;
    margin-left: 60px;
    margin-right: 15px;
    padding: 0;
    position: relative;
}
.timeline>li>.timeline-item>.time {
    color: #999;
    float: right;
    padding: 10px;
    font-size: 12px;
}
.timeline>li>.timeline-item>.timeline-header {
    margin: 0;
    color: #555;
    border-bottom: 1px solid #f4f4f4;
    padding: 10px;
    font-size: 16px;
    line-height: 1.1;
    font-weight: 600;
}
.timeline>li>.timeline-item>.timeline-body, .timeline>li>.timeline-item>.timeline-footer {
    padding: 10px;
}
.timeline>li>.timeline-item>.timeline-body, .timeline>li>.timeline-item>.timeline-footer {
    padding: 10px;
}
.timeline>li>.fa, .timeline>li>.glyphicon, .timeline>li>.ion {
    width: 30px;
    height: 30px;
    font-size: 13px;
    line-height: 30px;
    position: absolute;
    color: #666;
    background: #d2d6de;
    border-radius: 50%;
    text-align: center;
    left: 18px;
    top: 0;
}

</style>
