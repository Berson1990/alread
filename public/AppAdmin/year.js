ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var year = new Vue({
    el: '#year',
    data: {
        url: 'http://muthaber-admin.muthaberapp.com/',
        yearData: [],
        Grade: [],
        dialogFormVisible: false,
        formLabelWidth: '120px',
        form: {
            year: '',
            grade_id: ''
        },
        customFilters: [{
            vals: '',
            props: ['year', 'grade']
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
            url: self.url + "alltear",
            method: 'Get'

        }).done(function (result) {

            self.yearData = result;

            // console.log(self.yearData);
        });

        $.ajax({
            url: self.url + "allgrade",
            method: 'Get'

        }).done(function (result) {

            self.Grade = result;

            console.log(self.Grade);
        });
    },
    methods: {
        handleEdit: function (index, row) {
            console.log(row);
            this.form = {
                year_id: row.year_id,
                year: row.year,
                grade_id  : row.grade_id,
                grade:row.grade
            };
            this.dialogFormVisible = true;
        },
        Save: function () {

            console.log(this.form);
            console.log(this.form.year_id);
            if (this.form.year_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            $.ajax({
                url: self.url + "updateyear/" + this.form.year_id,
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
            $.ajax({
                url: self.url + "createyear",
                method: 'Post',
                data: this.form
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });

                year.yearData.push(result);
            });

        },

        Close: function () {
            this.dialogFormVisible = false;
        },
        handleDelete: function (index, row) {
            var self = this;
            console.log(index, row);

            $.ajax({
                url: self.url + "deleteyear/" + row.year_id,
                method: 'delete'
            }).done(function (result) {
                console.log(result);
                year.yearData.splice(index);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
            });
        }
    }
});