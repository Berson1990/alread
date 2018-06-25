ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var grade = new Vue({
    el: '#grade',
    data: {
        url: 'http://muthaber-admin.muthaberapp.com/',
        gradeData: [],
        dialogFormVisible: false,
        formLabelWidth: '120px',
        form: {
            grade: ''
        },
        customFilters: [{
            vals: '',
            props: ['grade']
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
            url: self.url + "allgrade",
            method: 'Get'

        }).done(function (result) {

            self.gradeData = result;

            console.log(self.gradeData);
        });
    },
    methods: {
        handleEdit: function (index, row) {
            console.log(row);
            this.form = {
                grade_id: row.grade_id,
                grade: row.grade
            };
            this.dialogFormVisible = true;
        },
        Save: function () {

            console.log(this.form);
            console.log(this.form.grade_id);
            if (this.form.grade_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            $.ajax({
                url: self.url + "updategrade/" + this.form.grade_id,
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
                url: self.url + "creategrade",
                method: 'Post',
                data: this.form
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });

                grade.gradeData.push(result);
            });

        },

        Close: function () {
            this.dialogFormVisible = false;
        },
        handleDelete: function (index, row) {
            var self = this;
            console.log(index, row);

            $.ajax({
                url: self.url + "deletegrade/" + row.grade_id,
                method: 'delete'
            }).done(function (result) {
                console.log(result);
                grade.gradeData.splice(index);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
            });
        }
    }
});