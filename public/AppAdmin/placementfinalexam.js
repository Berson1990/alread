ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var PlacementFinalExam = new Vue({
    el: '#PlacementFinalExam',

    data: {
        PlacementQuestionsData: [],
        formLabelWidth: '150px',
        dialogFormVisible: false,
        loading: true,
        isEditMode:
            false,
        BaseUrl:
            'http://muthaber-admin.muthaberapp.com/',
        PlacementExamForm:
            {
                question: '',
                placement_id: '',
                answer1: '',
                answer2: '',
                answer3: '',
                correct: ''

            }
        ,
        customFilters: [{
            vals: '',
            props: ['question', 'answer1', 'answer2', 'answer3', 'correct',]
        }, {
            vals: []
        }],
        actionsDef:
            {
                colProps: {
                    span: 8
                }
                ,
                def: [{
                    name: 'new',
                    handler: function () {
                        this.$message("new clicked")
                    }

                }]
            }
    },
    mounted: function () {
        var self = this;
        self.GetPlacementExam();

    },
    methods: {
        GetPlacementExam: function () {
            var self = this;
            var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
            console.log(id);
            axios.get(self.BaseUrl + 'getfinalexamquestions/' + id)
                .then(function (response) {
                    // console.log(response.data);
                    PlacementFinalExam.PlacementQuestionsData = response.data;
                    self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
        }
        ,
        AddEdit: function (index, row, isEditMode) {
            var self = this;
            if (self.isEditMode === false) {
                self.PlacementExamForm = {}
            } else {
                self.PlacementExamForm = row;
            }

        },
        Save: function () {
            var self = this;
            self.isEditMode ? self.Update() : self.Create();
        },
        Create: function () {
            var self = this;
            self.loading = true;
            axios.post(self.BaseUrl + 'createfinalexamquetions',
                self.PlacementExamForm
            ).then(function (response) {
                console.log(response.data);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
                PlacementFinalExam.PlacementQuestionsData.push(response.data);
                self.loading = false;
            }).catch(function (error) {
                console.log(error);
            })
        },
        Update: function () {
            var self = this;
            self.loading = true;
            axios.put(self.BaseUrl + 'updatefinalexamquestion/' + self.PlacementExamForm.placement_exam_id,
                self.PlacementExamForm
            ).then(function (response) {
                console.log(response.data);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
                self.loading = false;
            }).catch(function (error) {
                console.log(error);
            })
        },
        Delete: function (index, row) {
            var self = this;
            self.loading = true;
            axios.delete(self.BaseUrl + 'deletefinalexamquestion/' + row.placement_exam_id)
                .then(function (response) {
                    console.log(response.data);
                    self.$message({
                        showClose: true,
                        message: 'تم بنجاح',
                        type: 'success'
                    });
                    PlacementFinalExam.PlacementQuestionsData.splice(index, 1);
                    self.loading = false;
                }).catch(function (error) {
                console.log(error);
            })
        }

    }
});