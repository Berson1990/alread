ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
img = '';
$(document).ready(function () {

    function readFile() {
        if (this.files && this.files[0]) {
            var FR = new FileReader();
            FR.onload = function (e) {
                iamge_url = e.target.result;


            };

            FR.readAsDataURL(this.files[0]);
        }

    }

    document.getElementById("SalesCat_img").addEventListener("change", readFile, false);

});


var bankaccount = new Vue({
    el: '#bankaccount',
    data: {
        url: 'http://muthaber-admin.muthaberapp.com/',
        bankaccountData: [],

        dialogFormVisible: false,
        formLabelWidth: '120px',
        form: {
            account_no: '',
            owner_name: '',
            imge: '',
            swift_code: '',
            bank_name: ''
        },
        customFilters: [{
            vals: '',
            props: [
                'account_no',
                'owner_name',
                'swift_code',
                'bank_name'
            ]
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
            url: self.url + "albankaccount", method: 'Get'
        }).done(function (result) {
            self.bankaccountData = result;
            console.log(self.bankaccountData);
        });
    },
    methods: {
        handleEdit: function (index, row) {
            console.log(row);
            this.form = {
                bankaccount_id: row.bankaccount_id,
                account_no: row.account_no,
                owner_name: row.owner_name,
                imge: row.imge,
                swift_code: row.swift_code,
                bank_name: row.bank_name

            };
            this.dialogFormVisible = true;
        },
        Save: function () {

            console.log(this.form);
            console.log(this.form.bankaccount_id);
            if (this.form.bankaccount_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            self.form.imge = img;
            console.log(self.form);
            $.ajax({
                url: self.url + "updatebankaccount/" + this.form.bankaccount_id,
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
            self.form.imge = img;
            console.log(self.form);
            $.ajax({
                url: self.url + "createbankaccount",
                method: 'Post',
                data: this.form
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });

                bankaccount.bankaccountData.push(result);
            });

        },

        Close: function () {
            this.dialogFormVisible = false;
        },
        handleDelete: function (index, row) {
            var self = this;
            console.log(index, row);

            $.ajax({
                url: self.url + "deletebankaccount/" + row.bankaccount_id,
                method: 'delete'
            }).done(function (result) {
                console.log(result);
                bankaccount.bankaccountData.splice(index);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
            });
        }
    }
});