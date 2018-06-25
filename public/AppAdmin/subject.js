ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
iamge_url = '';
$(document).ready(function () {

    function readFile() {
        if (this.files && this.files[0]) {
            var FR = new FileReader();
            FR.onload = function (e) {
                iamge_url = e.target.result;
                console.log(iamge_url);
            };

            FR.readAsDataURL(this.files[0]);
        }

    }

    document.getElementById("SalesCat_img").addEventListener("change", readFile, false);

});


var subject = new Vue({
    el: '#subject',
    data: {
        url: 'http://muthaber-admin.muthaberapp.com/',
        subjectData: [],
        Grade: [],
        Year: [],
        dialogFormVisible: false,
        formLabelWidth: '120px',
        form: {
            name: '',
            year_id: '',
            grade_id: ''
        },
        customFilters: [{
            vals: '',
            props: ['name', 'grade', 'year']
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

        /*this for grid*/
        $.ajax({
            url: self.url + "allsubjectadmin", method: 'Get'
        }).done(function (result) {
            self.subjectData = result;
            console.log(self.subjectData);
        });
        /*this for lockups*/

        $.ajax({
            url: self.url + "allgrade", method: 'Get'
        }).done(function (result) {
            self.Grade = result;
            console.log(self.Grade);
        });
    },
    methods: {


        handleEdit: function (index, row) {
            console.log(row);
            this.form = {
                subject_id: row.subject_id,
                name: row.name,
                year_id: row.year_id,
                grade_id: row.grade_id

            };
            this.dialogFormVisible = true;
        },
        Save: function () {

            console.log(this.form);
            console.log(this.form.subject_id);
            if (this.form.subject_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            self.form.image = iamge_url;
            $.ajax({
                url: self.url + "updatesubject/" + this.form.subject_id,
                method: 'Put',
                data: this.form

            }).done(function (result) {
                console.log(result);
                // this.SalesItem = result;
                // SalesCategory.SalesItem.push(result[0]);
                // var Ids = _.map(this.SalesItem, 'id');
                // var Index = _.in.dexOf(Ids, result.id);
                // SalesCategory.SalesItem[Index] = result;
                // grade.gradeData.push(result);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
                location.reload();
            });
        },
        create: function () {

            var self = this;
            self.form.image = iamge_url;
            console.log(self.form);
            $.ajax({
                url: self.url + "createsubject",
                method: 'Post',
                data: this.form
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });

                subject.subjectData.push(result[0]);
            });

        },

        Close: function () {
            this.dialogFormVisible = false;
        },
        handleDelete: function (index, row) {
            var self = this;
            console.log(index, row);

            $.ajax({
                url: self.url + "deletesubject/" + row.subject_id,
                method: 'delete'
            }).done(function (result) {
                console.log(result);
                subject.subjectData.splice(index);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
            });
        },
        getYear: function (grade_id) {
            var self = this;
            $.ajax({
                url: self.url + "api/getYear/" + grade_id,
                method: 'Get'
            }).done(function (result) {
                self.Year = result;
                console.log(self.Year);
            });
        }

    }
});