ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var Placement = new Vue({
    el: '#Placement',

    data: {
        dir: 'rtl',
        PlacementData: [],
        formLabelWidth: '300px',
        dialogFormVisible: false,
        loading: true,
        isEditMode:
            false,
        BaseUrl:
            'http://muthaber-admin.muthaberapp.com/',
        PlacementForm:
            {
                placement: '',
                placement_duration: '',
                correct_quetisons_from: '',
                correct_quetisons_to: '',
                correct_final_exam_from: '',
                correct_final_exam_to: ''

            }
        ,
        customFilters: [{
            vals: '',
            props: ['placement', 'placement_duration', 'correct_quetisons_from', 'correct_quetisons_to', 'correct_final_exam_from', 'correct_final_exam_to']
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
            axios.get(self.BaseUrl + 'getplacement')
                .then(function (response) {
                    console.log(response.data);
                    Placement.PlacementData = response.data;
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
                self.PlacementForm = {}
            } else {
                self.PlacementForm = row;
            }

        },
        Save: function () {
            var self = this;
            self.isEditMode ? self.Update() : self.Create();
        },
        Create: function () {
            var self = this;
            self.loading = true;
            axios.post(self.BaseUrl + 'createplacement', self.PlacementForm)
                .then(function (response) {
                    console.log(response.data);
                    self.$message({
                        showClose: true,
                        message: 'تم بنجاح',
                        type: 'success'
                    });
                    Placement.PlacementData.push(response.data);
                    self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        Update: function () {
            var self = this;
            self.loading = true;
            axios.put(self.BaseUrl + 'eidtplacement/' + self.PlacementForm.placement_id, self.PlacementForm)
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
            axios.delete(self.BaseUrl + 'deleteplacement/' + row.placement_id)
                .then(function (response) {
                    console.log(response.data);
                    self.$message({
                        showClose: true,
                        message: 'تم بنجاح',
                        type: 'success'
                    });
                    Placement.PlacementData.splice(index, 1);
                    self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        GotToAddFinalPlacementExam: function (index, row) {

            window.location.href = 'placement_final_exam/' + row.placement_id;

        }
    }
});