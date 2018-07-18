ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var PlacementPayment = new Vue({
    el: '#PlacementPayment',

    data: {
        PlacementPaymentData: [],
        formLabelWidth: '150px',
        dialogFormVisible: false,
        loading: true,
        isEditMode:
            false,
        BaseUrl:
            'http://muthaber-admin.muthaberapp.com/',
        PlacementExamForm:
            {
                question: '',
                placement_id: '',
                answer1: '',
                answer2: '',
                answer3: '',
                correct: ''

            }
        ,
        customFilters: [{
            vals: '',
            props: ['name', 'placement']
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
        self.GetPlacementPayment();

    },
    methods: {
        GetPlacementPayment: function () {
            var self = this;

            axios.get(self.BaseUrl + 'allplacement_payment')
                .then(function (response) {
                    console.log(response.data);
                    PlacementPayment.PlacementPaymentData = response.data;
                    self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                })
        }


    }
});