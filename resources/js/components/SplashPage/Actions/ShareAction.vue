<template>
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="/presentation">
                    <input type="hidden" name="_token" :value="csrf" />
                    <div class="modal-header bg-main">
                        <h5
                            class="modal-title text-white"
                            id="exampleModalLabel"
                        >
                            Share a Presentation
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-main">
                        <div class="form-group row">
                            <label
                                for="title"
                                class="col-sm-4 col-form-label text-white"
                                >Presentation Name</label
                            >
                            <div class="col-sm-8">
                                <input
                                    id="title"
                                    name="title"
                                    placeholder="Presentation Name"
                                    value=""
                                    required
                                    v-model="title"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="password"
                                class="col-sm-4 col-form-label text-white"
                                >Password (optional)</label
                            >
                            <div class="col-sm-8">
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    placeholder="Password"
                                    v-model="password"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-main">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="submit" class="btn btn-secondary">
                            Start Presentation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.input-group {
    padding-right: 0;
    padding-left: 0;
}
</style>

<script>
export default {
    data() {
        return {
            password: null,
            title: null,
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        };
    },
    mounted() {},
    methods: {
        handleStartPresentation() {
            const body = {
                title: this.title,
                password: this.password
            };
            console.log(body);
            console.log(process.env.MIX_APP_URL);
            axios.post(process.env.MIX_APP_URL + "/presentation", body).then(
                response => {
                    console.log(response.data);
                },
                error => {
                    console.log(error);
                }
            );
        }
    }
};
</script>
