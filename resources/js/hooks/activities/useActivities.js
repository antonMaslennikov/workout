import axios from "axios";
import {onMounted, ref} from "vue";

export function useActivities(page, limit) {

    const activities = ref([]);
    const isLoading = ref(true);

    const fetching = async () => {
        try {
            isLoading.value = true;

            const response = await axios.get('/api/activities', {
                params: {
                    limit: limit,
                    page: page,
                }
            });

            activities.value = response.data;
        } catch (e) {
            alert('Ошибка');
        } finally {
            isLoading.value = false;
        }
    }

    onMounted(fetching)

    return {
        activities,
        isLoading
    }
}
