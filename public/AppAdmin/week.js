ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var week = new Vue({
    el: '#week',
    data: {
        url: 'http://muthaber-admin.muthaberapp.com/',
        weekData: [],
        dialogFormVisible: false,
        formLabelWidth: '120px',
        form: {
            week: ''
        },
        customFilters: [{
            vals: '',
            props: ['week']
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
            url: self.url + "allweek",
            method: 'Get'

        }).done(function (result) {

            self.weekData = result;

            console.log(self.weekData);
        });
    },
    methods: {
        handleEdit: function (index, row) {
            console.log(row);
            this.form = {
                week_id: row.week_id,
                week: row.week
            };
            this.dialogFormVisible = true;
        },
        Save: function () {

            console.log(this.form);
            console.log(this.form.week_id);
            if (this.form.week_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            $.ajax({
                url: self.url + "updateweek/" + this.form.week_id,
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
                url: self.url + "createweek",
                method: 'Post',
                data: this.form
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });

                week.weekData.push(result);
            });

        },

        Close: function () {
            this.dialogFormVisible = false;
        },
        handleDelete: function (index, row) {
            var self = this;
            console.log(index, row);

            $.ajax({
                url: self.url + "deleteweek/" + row.week_id,
                method: 'delete'
            }).done(function (result) {
                console.log(result);
                week.weekData.splice(index);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
            });
        }
    }
});