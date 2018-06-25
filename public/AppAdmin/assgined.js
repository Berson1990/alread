ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var assgined = new Vue({
        el: '#assgined',
        data: {
            url: 'http://muthaber-admin.muthaberapp.com/',
            teacherData: [],
            teacher_assgin: [],
            Grade: [],
            Year: [],
            Subject: [],
            dialogFormVisible: false,
            dialogTableVisible: false,
            formLabelWidth: '120px',
            form: {
                teacher_id: '',
                grade_id: '',
                year_id: '',
                subject_id: ''
            },
            customFilters: [{
                vals: '',
                props: ['name']
            }, {
                vals: []
            }],
            actionsDef: {
                colProps: {
                    span: 8
                },
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
            $.ajax({
                url: self.url + "teacher_assgined",
                method: 'Get'
            }).done(function (result) {
                self.teacherData = result;
                console.log(self.teacherData);
            });
        },
        methods: {
            deleteAssgin: function (assgin, index, teacher_assgin) {
                console.log(assgin);
                console.log(index);
                teacher_assgin.splice(index, 1);
                var self = this;
                $.ajax({
                    url: self.url + "deleteassgin/" + assgin.assgin_id,
                    method: 'Delete'

                }).done(function (result) {
                    console.log(result)
                });

            },
            getassgin: function (index, row) {

                var self = this;
                self.dialogTableVisible = true;
                console.log(row);
                $.ajax({
                    url: self.url + "getassgin/" + row.user_id,
                    method: 'Get'

                }).done(function (result) {

                    self.teacher_assgin = result;

                    console.log(self.teacher_assgin);
                });
            }

        }
    })
;