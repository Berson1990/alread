ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var PlacementDetermine = new Vue({
    el: '#PlacementDetermine',

    data: {
        PlacementQuestionsData: [],
        formLabelWidth: '150px',
        dialogFormVisible: false,
        loading: true,
        isEditMode:
            false,
        BaseUrl:
            'http://muthaber-admin.muthaberapp.com/',
        PlacementDeterminForm:
            {
                question: '',
                answer1: '',
                answer2: '',
                answer3: '',
                correct: ''

            }
        ,
        customFilters: [{
            vals: '',
            props: ['question', 'answer1', 'answer2', 'answer3', 'correct', '']
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
        self.GetPlacement();

    },
    methods: {
        GetPlacement: function () {
            var self = this;
            axios.get(self.BaseUrl + 'getquestions')
                .then(function (response) {
                    console.log(response.data);
                    PlacementDetermine.PlacementQuestionsData = response.data;
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
                self.PlacementDeterminForm = {}
            } else {
                self.PlacementDeterminForm = row;
            }

        },
        Save: function () {
            var self = this;
            self.isEditMode ? self.Update() : self.Create();
        },
        Create: function () {
            var self = this;
            self.loading = true;
            axios.post(self.BaseUrl + 'createquetions', self.PlacementDeterminForm)
                .then(function (response) {
                    console.log(response.data);
                    self.$message({
                        showClose: true,
                        message: 'تم بنجاح',
                        type: 'success'
                    });
                    PlacementDetermine.PlacementQuestionsData.push(response.data);
                    self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        Update: function () {
            var self = this;
            self.loading = true;
            axios.put(self.BaseUrl + 'updatequestion/' + self.PlacementDeterminForm.placement_questions_id, self.PlacementDeterminForm)
                .then(function (response) {
                    console.log(response.data);
                    self.$message({
                        showClose: true,
                        message: 'تم بنجاح',
                        type: 'success'
                    });
                    self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        Delete: function (index, row) {
            var self = this;
            self.loading = true;
            axios.delete(self.BaseUrl + 'deletequestion/' + row.placement_questions_id)
                .then(function (response) {
                    console.log(response.data);
                    self.$message({
                        showClose: true,
                        message: 'تم بنجاح',
                        type: 'success'
                    });
                    PlacementDetermine.PlacementQuestionsData.splice(index, 1);
                    self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
        }

    }
});