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
        $.ajax({
            url: self.url + "studentstat",
            method: 'Get'

        }).done(function (result) {

            self.studentData = result;

            console.log(self.studentData);
        });
    }



});