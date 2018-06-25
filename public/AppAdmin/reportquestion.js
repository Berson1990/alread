ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var report = new Vue({

    el: '#report',
    data: {
        ReportData: [],
        url: 'http://muthaber-admin.muthaberapp.com/',
        customFilters: [{
            vals: '',
            props: ['TeacherName',
                'StuedntName',
                'question',
                'report']
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
            url: self.url + "getReport",
            method: 'Get'

        }).done(function (result) {

            self.ReportData = result;

            console.log(self.ReportData);
        });
    }


});