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
                <form method="GET" action="presentation">
                    <div class="modal-header bg-main">
                        <h5
                            class="modal-title text-white"
                            id="exampleModalLabel"
                        >
                            Join a Presentation
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
                                for="presentation_id"
                                class="col-sm-4 col-form-label text-white"
                                >Presentation Id</label
                            >
                            <div class="col-sm-8">
                                <input
                                    id="presentation_id"
                                    name="presentation_id"
                                    type="text"
                                    placeholder="Presentation Id"
                                    required
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
                            Join Presentation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped></style>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
    methods: {}
};
</script>
