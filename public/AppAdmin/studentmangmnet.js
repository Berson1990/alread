ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var studentmanagment = new Vue({
    el: '#studentmanagment',
    data: {
        url: 'http://muthaber-admin.muthaberapp.com/',
        studentData: [],
        dialogFormVisible: false,
        formLabelWidth: '120px',
        customFilters: [{
            vals: '',
            props: ['name', 'phone', 'mail']
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
            url: self.url + "student",
            method: 'Get'

        }).done(function (result) {

            self.studentData = result;

            console.log(self.studentData);
        });
    },
    methods: {

        update: function (index, row, state) {
            var self = this;
            $.ajax({
                url: self.url + "changestate/" + row.user_id + '/' + state,
                method: 'get'

            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
                location.reload();
            });
        }
    }


});