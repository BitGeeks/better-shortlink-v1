<script>
export default {
    data() {
        return {
            entry: {},
            routeKeyName: "id",
            resource: {
                name: "users",
                ready: false,
                mode: this.$route.meta.mode,
                routes: {
                    show: null,
                    update: null,
                    destroy: null,
                    store: null
                },
                endpoint: null
            },
            errors: {},
            saving: false,
            deleteConfirmMessage:
                "Are you sure you want to completely remove the resource? Tihs action cannot be undone."
        };
    },
    computed: {
        editing() {
            return this.resource.mode !== "create";
        }
    },
    methods: {
        /**
         * Callbacks
         */
        onFetch() {},
        redirectOnStore() {
            this.$router.push({
                name: this.resource.name + ".edit",
                params: {
                    id: this.entry.id
                }
            });
        },
        onStore() {
            this.$toast.success("Entry saved");

            this.redirectOnStore();
        },
        onUpdate() {
            this.$toast.success("Entry updated");
        },
        redirectOnDestroy() {
            this.$router.push({
                name: this.resource.name + ".index"
            });
        },
        onDestroy() {
            this.$toast.success("Entry deleted");

            this.redirectOnDestroy();
        },
        onError(message) {
            this.$toast.error(message);
        },
        afterSubmit() {},

        /**
         * Default methods
         */
        fetch() {
            axios
                .get(this.resource.routes.show)
                .then(response => response.data.data)
                .then(entry => {
                    this.entry = entry;
                    this.onFetch();
                    this.resource.ready = true;
                })
                .catch(error => {
                    //
                });
        },
        submit() {
            if (this.editing) {
                this.update();
            } else {
                this.store();
            }
        },
        store() {
            this.saving = true;
            axios
                .post(this.resource.routes.store, this.entry)
                .then(response => response.data.data)
                .then(entry => {
                    this.entry = entry;
                    this.onStore();
                    this.errors = {};
                    this.saving = false;
                    this.afterSubmit();
                })
                .catch(error => {
                    this.saving = false;
                    if (error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else if (error.response.data.message) {
                        this.onError(error.response.data.message);
                    }

                    this.afterSubmit();
                });
        },
        update() {
            this.saving = true;
            axios
                .put(this.resource.routes.update, this.entry)
                .then(response => response.data.data)
                .then(entry => {
                    this.onUpdate();
                    this.errors = {};
                    this.saving = false;
                })
                .catch(error => {
                    this.saving = false;
                    if (error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else if (error.response.data.message) {
                        this.onError(error.response.data.message);
                    }
                });
        },
        async destroy() {
            let confirmed = false;

            await this.$swal({
                title: "Confirm action",
                text: this.deleteConfirmMessage,
                showCancelButton: true,
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel"
            }).then(result => {
                if (result.value) {
                    confirmed = true;
                }
            });

            if (!confirmed) {
                return false;
            }

            axios
                .delete(this.resource.routes.destroy)
                .then(response => {
                    this.onDestroy();
                    this.errors = {};
                })
                .catch(error => {
                    if (error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                    if (error.response.data.message) {
                        this.onError(error.response.data.message);
                    }
                });
        },

        setUpRoutes() {
            for (let route in this.resource.routes) {
                if (!this.resource.routes[route]) {
                    this.resource.routes[route] =
                        route == "store"
                            ? this.resource.endpoint
                            : this.resource.endpoint + "/" + this.entry.id;
                }
            }
        },

        onMount() {}
    },
    mounted() {
        this.onMount();

        if (!this.entry.id) {
            this.entry.id = this.editing
                ? this.$route.params[this.routeKeyName]
                : null;
        }

        this.setUpRoutes();

        if (this.editing) {
            this.fetch();
        } else {
            this.resource.ready = true;
        }
    }
};
</script>