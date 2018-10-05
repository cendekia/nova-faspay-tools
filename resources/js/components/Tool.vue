<template>
    <div>
        <heading class="mb-6">Recurring Check</heading>
        <card>
            <form @submit.prevent="showMember">
                <div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Member ID</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member.id" type="text" class="w-full form-control form-input form-input-bordered">
                            <p class="text-sm leading-normal text-80 italic">member id is a code that registered to faspay when do the recurring payment</p>
                        </div>
                    </div>
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Member Email</label>
                        </div>
                        <div class="w-1/2 px-8 py-6">
                            <input v-model="member.email" type="email" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                </div>
                <div class="bg-30 flex px-8 py-4">
                    <router-link :to="{ name: 'faspay.recurring.form', params: { member_data: responses } }"
                        class="mr-auto btn btn-default btn-primary"
                        v-if="responses.response_code == 00"
                    >
                        Edit Member Data
                    </router-link>
                     <router-link :to="{ name: 'faspay.recurring.check', query: { member_email: member.email, member_id: member.id  } }"
                        class="ml-auto btn btn-default btn-primary"
                        v-on:click.native="showMember"
                    >
                        Check
                    </router-link>
                </div>

            </form>
        </card>
        <card v-if="show_response">
            <prism language="javascript">{{ responses }}</prism>
        </card>
    </div>
</template>

<script>
import Prism from 'vue-prism-component'

export default {
    data() {
        return {
            member: {},
            show_response: false,
            responses: {}
        }
    },
    components: {
        Prism
    },
    created(){
        if (this.$route.query.member_id && this.$route.query.member_email) {
            this.member.id = this.$route.query.member_id
            this.member.email = this.$route.query.member_email
            this.showMember()
        }
    },
    methods: {
        showMember() {
            this.$route.query.member_id = this.member.id
            this.$route.query.member_email = this.member.email
            Nova.request().post("/nova-vendor/faspay-tools/recurring-member/"+this.member.id, {member: this.member})
                .then(response => {
                    this.show_response = true
                    this.responses = response.data

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
