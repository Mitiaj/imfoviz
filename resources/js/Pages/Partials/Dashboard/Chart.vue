<script setup>
import LineChart from "@/Components/Chart/LineChart";
import ColumnChart from "@/Components/Chart/ColumnChart";
import BarChart from "@/Components/Chart/BarChart";
import PieChart from "@/Components/Chart/PieChart";
import AreaChart from "@/Components/Chart/AreaChart";

defineProps({
    type: String,
    data: Array
})
</script>
<template>
    <div>
        <ColumnChart v-if="this.type === 'column'" :data="this.data"></ColumnChart>
        <BarChart v-if="this.type === 'bar'" :data="this.data"></BarChart>
        <PieChart v-if="this.type === 'pie'" :data="this.data"></PieChart>
        <LineChart v-if="this.type === 'line'" :data="this.data"></LineChart>
        <AreaChart v-if="this.type === 'area'" :data="this.data"></AreaChart>
    </div>

</template>

<script>
    export default {
    }
</script>
