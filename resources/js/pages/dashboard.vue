<script setup>

    import AnalyticsCongratulations from '@/views/dashboard/AnalyticsCongratulations.vue'
    import AnalyticsFinanceTabs from '@/views/dashboard/AnalyticsFinanceTab.vue'
    import AnalyticsOrderStatistics from '@/views/dashboard/AnalyticsOrderStatistics.vue'
    import AnalyticsProfitReport from '@/views/dashboard/AnalyticsProfitReport.vue'
    import AnalyticsTotalRevenue from '@/views/dashboard/AnalyticsTotalRevenue.vue'
    import AnalyticsTransactions from '@/views/dashboard/AnalyticsTransactions.vue'

    import chart from '@images/cards/chart-success.png'
    import card from '@images/cards/credit-card-primary.png'
    import paypal from '@images/cards/paypal-error.png'
    import wallet from '@images/cards/wallet-info.png'

    import axios from 'axios';
    import { ref, onMounted } from 'vue';

    const totalTaskString = ref('');
    const totalTaskInt  = ref(0);

    const totalCompanisString = ref('');
    const totalCompanisInt  = ref(0);

    const totalUserString = ref('');
    const totalUserInt  = ref(0);

    const datos = async () => {
        const res = await axios.get('/tasks'); 
       
        

        if (res.status === 200) {
            const total = res.data.length;
            totalTaskString.value = total.toString(); 
            totalTaskInt.value = total;     
        }

        const res1 = await axios.get('/companies'); 
        if (res1.status === 200) {
            const total = res1.data.length;
            totalCompanisString.value = total.toString(); 
            totalCompanisInt.value = total;    
        }

        const res2 = await axios.get('/users'); 
        if (res2.status === 200) {
            let total = res2.data.length;
            totalUserString.value = total.toString(); 
            totalUserInt.value = total;     
        }
    };
   
    onMounted(() => {
        datos();
    });

</script>

<template>
    <VRow>
        <!-- 👉 Congratulations -->
        <!-- <VCol
        cols="12"
        md="8"
        >
        <AnalyticsCongratulations />
        </VCol> -->

        <VCol cols="12">
            <VRow>
                <VCol cols="4" md="4">
                    <CardStatisticsVertical v-bind="{
                        title: 'Total de tareas',
                        image: chart,
                        stats: totalTaskString,
                        change: totalTaskInt
                    }"/>
                </VCol>
                <VCol cols="4" md="4">
                    <CardStatisticsVertical v-bind="{
                        title: 'Total de compañias',
                        image: wallet,
                        stats: totalCompanisString,
                        change: totalCompanisInt,
                    }" />
                </VCol>
                <VCol cols="4" sm="4">
                    <CardStatisticsVertical v-bind="{
                        title: 'Total de usuarios',
                        image: paypal,
                        stats: totalUserString,
                        change: totalUserInt,
                    }" />
                </VCol>
            </VRow>
        </VCol>


        <!-- <VCol
            cols="12"
            md="8"
            order="2"
            order-md="1"
        >
            <AnalyticsTotalRevenue />
        </VCol> -->

        <!-- 👉 Order Statistics -->
        <!--
            <VCol cols="12" md="4" sm="6" order="3">
                <AnalyticsOrderStatistics />
            </VCol> 
        -->

        <!-- 👉 Tabs chart -->
        <!-- 
            <VCol cols="12" md="4" sm="6" order="3">
                <AnalyticsFinanceTabs />
            </VCol> 
        -->

        <!-- 👉 Transactions -->
        <!-- <
            VCol cols="12" md="4" sm="6" order="3">
                <AnalyticsTransactions />
            </> 
        -->
    </VRow>
</template>
