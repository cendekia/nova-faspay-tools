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
                    <!-- <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Member Name</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member.name" type="text" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div> -->
                    <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Member Email</label>
                        </div>
                        <div class="w-1/2 px-8 py-6">
                            <input v-model="member.email" type="email" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div>
                    <!-- <div class="flex border-b border-40">
                        <div class="w-1/4 px-8 py-6">
                            <label class="inline-block text-80 h-9 pt-2">Recurring Amount</label>
                        </div>
                        <div class="w-3/4 px-8 py-6">
                            <input v-model="member.amount" type="number" class="w-full form-control form-input form-input-bordered">
                        </div>
                    </div> -->
                </div>
                <div class="bg-30 flex px-8 py-4">
                    <button type="submit" class="ml-auto btn btn-default btn-primary mr-3">
                        Check
                    </button>
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

const defaultMemberValue = {
    id: null,
    name: 'NA',
    email: null,
    amount: 1,
}

export default {
    data() {
        return {
            member: defaultMemberValue,
            show_response: false,
            responses: defaultMemberValue
        }
    },
    components: {
        Prism
    },
    mounted() {
        //
    },
    methods: {
        showMember() {
            Nova.request().post("/nova-vendor/faspay-tools/recurring-member/"+this.member.id, {member: this.member})
                .then(response => {
                    this.show_response = true
                    this.responses = response.data
                })
                .catch(() => this.error = true)
        }
    }
}
</script>

<style>
    /* Scoped Styles */
</style>
