import axios from "axios";
import {onMounted, ref} from "vue";

export function manipulateActivities() {

    const createActivitie = (activitie) => {
        axios
            .post('/api/activities', activitie, {
                headers: {
                    'Content-type':'application/json'
                }
            })
            .then(res => {
                if (res.data.status == 'ok') {
                    activitie.id = res.data.a.id;
                    this.activities.push(activitie);
                    this.closeModal();
                }
            });
    }

    const updateActivitie = (activitie) => {
        axios
            .post('/api/activities/' + activitie.id, {
                name : activitie.name,
                description : activitie.description,
                body_part : activitie.body_part,
                _method: 'PUT'
            })
            .then(res => {
                if (res.data.status == 'ok') {
                    this.activities = this.activities.map(item => {
                        if (item.id == activitie.id) {
                            return activitie;
                        } else {
                            return item;
                        }
                    });
                    this.closeModal();
                }
            });
    }

    const removeActivitie = function(activitie) {
        if (confirm('Подтверждаете удаление?')) {
            axios
                .post('/api/activities/' + activitie.id, {
                    _method: 'DELETE'
                })
                .then(response => {
                    this.activities = this.activities.filter(a => a.id !== activitie.id)
                });
        }
    }

    const saveSort = (order) => {
        axios
            .post('/api/activities/savesort', {'order' : order})
            .then(response => {
            });
    }

    return {
        createActivitie,
        updateActivitie,
        removeActivitie,
        saveSort
    }
}
