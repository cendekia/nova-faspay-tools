<template>
    <div>
        <heading class="mb-6">Faspay Recurring Member</heading>
        <card>
            <form @submit.prevent="updateMemberData">
                <div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Member ID</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.member_id" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Member Name</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.member_name" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Member Email</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.member_email" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Member Email Notif</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.member_email_notif" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring Date Schedule</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.process_date" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring Amount</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.recurring_amount" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring Start Date</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.recurring_start_date" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring End Date</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.recurring_end_date" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring Period</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.recurring_period" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring Period At</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.recurring_period_at" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring Accumulate</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.recurring_accumulate" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring Accumulate At</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.recurring_accumulate_at" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring Status</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member_data.recurring_status" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                </div>
                <div class="bg-30 flex px-8 py-4">
                    <button type="submit" class="ml-auto btn btn-default btn-primary">
                        Update Data
                    </button>
                </div>
            </form>
        </card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            member_data: {},
        }
    },
    created() {
        this.member_data = (this.$route.params.member_data) ? this.$route.params.member_data : {}
        this.member_data.member_email_notif = 0
        this.member_data.recurring_accumulate = 1
        this.member_data.recurring_accumulate_at = 0
        this.member_data.recurring_status = 1
    },
    mounted() {
        //
    },
    methods: {
        updateMemberData() {
            Nova.request().post("/nova-vendor/faspay-tools/update-member/"+this.member_data.member_id, {member: this.member_data})
                .then(response => {
                    if (response.data.response_code == '00') {
                        this.$toasted.success('['+response.data.response+'] '+response.data.response_desc)
                    } else {
                        this.$toasted.error('['+response.data.response+'] '+response.data.response_desc)
                    }
                })
                .catch(() => this.error = true)
        }
    }
}
</script>

<style>
    /* Scoped Styles */
</style>
