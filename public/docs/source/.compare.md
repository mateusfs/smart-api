---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->



# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#Contest
<!-- START_b1313b6371954d24fafd7ef13a8d213d -->
## Dispute Contest IUGU

Dispute Contest | Exemplo: api/v1/contest/dispute/

> Example request:

```bash
curl -X POST "http://localhost/api/v1/contest/dispute" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/contest/dispute",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/contest/dispute`


<!-- END_b1313b6371954d24fafd7ef13a8d213d -->

<!-- START_19ca24bb67a31858fde80b603205fd0a -->
## Dispute Contest IUGU

Dispute contest | Exemplo: api/v1/contest/obey/$idContestation

> Example request:

```bash
curl -X GET "http://localhost/api/v1/contest/obey/{idContestation}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/contest/obey/{idContestation}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/contest/obey/{idContestation}`

`HEAD api/v1/contest/obey/{idContestation}`


<!-- END_19ca24bb67a31858fde80b603205fd0a -->

<!-- START_8389bdceda54bf8364c7609a7bfdf480 -->
## Search Contest IUGU

Search Contest | Exemplo: api/v1/contest/search/$idContestation

> Example request:

```bash
curl -X GET "http://localhost/api/v1/contest/search/{idContestation}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/contest/search/{idContestation}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/contest/search/{idContestation}`

`HEAD api/v1/contest/search/{idContestation}`


<!-- END_8389bdceda54bf8364c7609a7bfdf480 -->

<!-- START_b622e2e595f29cd8a0e266d64f9b1154 -->
## List Contest IUGU

List a contest | Exemplo: api/v1/contest/list/$idContestation

> Example request:

```bash
curl -X GET "http://localhost/api/v1/contest/list" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/contest/list",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/contest/list`

`HEAD api/v1/contest/list`


<!-- END_b622e2e595f29cd8a0e266d64f9b1154 -->

#Debt
<!-- START_74a7dfba4f54475f47ebf0d76a1f719a -->
## Search Debt

Search Debt | Exemplo: api/v1/debt/$idDbt

> Example request:

```bash
curl -X GET "http://localhost/api/v1/debt/{idDbt}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/debt/{idDbt}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/debt/{idDbt}`

`HEAD api/v1/debt/{idDbt}`


<!-- END_74a7dfba4f54475f47ebf0d76a1f719a -->

<!-- START_fe6f39b07ae556fa89e213cb57f2aa07 -->
## Create Debt

Create Debt | Exemplo: api/v1/debt/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/debt/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/debt/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/debt/create`


<!-- END_fe6f39b07ae556fa89e213cb57f2aa07 -->

<!-- START_ca0d39d09ea55ce7847bc8145ef878de -->
## Update Debt

Update Debt | Exemplo: api/v1/debt/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/debt/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/debt/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/debt/update`


<!-- END_ca0d39d09ea55ce7847bc8145ef878de -->

<!-- START_d06a4c66001e43c3e04a7eaf9b1775cf -->
## Remove Debt

Remove Debt | Exemplo: api/v1/debt/delete/$idDbt

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/debt/delete/{idDbt}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/debt/delete/{idDbt}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/debt/delete/{idDbt}`


<!-- END_d06a4c66001e43c3e04a7eaf9b1775cf -->

#Fee
<!-- START_3ba780166bd2a9cd5b1123ea63559bed -->
## Search Fee

Search Fee | Exemplo: api/v1/fee/$idFee

> Example request:

```bash
curl -X GET "http://localhost/api/v1/fee/{idFee}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/fee/{idFee}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/fee/{idFee}`

`HEAD api/v1/fee/{idFee}`


<!-- END_3ba780166bd2a9cd5b1123ea63559bed -->

<!-- START_5b68964e02d2af0cc88533c8bc9f35c3 -->
## Create Fee

Create Fee | Exemplo: api/v1/fee/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/fee/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/fee/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/fee/create`


<!-- END_5b68964e02d2af0cc88533c8bc9f35c3 -->

<!-- START_cea98791d04c06bfa42f75578368c1e9 -->
## Update Fee

Update Fee | Exemplo: api/v1/fee/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/fee/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/fee/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/fee/update`


<!-- END_cea98791d04c06bfa42f75578368c1e9 -->

<!-- START_4e5cb9dafc1abc078dace61694409d59 -->
## Remove Fee

Remove Fee | Exemplo: api/v1/fee/delete/$idFee

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/fee/delete/{idFee}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/fee/delete/{idFee}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/fee/delete/{idFee}`


<!-- END_4e5cb9dafc1abc078dace61694409d59 -->

#Financial
<!-- START_c344eb6e0f5c466c2e886e2bd8f9d028 -->
## Financial Statement IUGU

Financial Statement | Exemplo: api/v1/financial/financialStatement

> Example request:

```bash
curl -X GET "http://localhost/api/v1/financial/financialStatement" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/financial/financialStatement",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/financial/financialStatement`

`HEAD api/v1/financial/financialStatement`


<!-- END_c344eb6e0f5c466c2e886e2bd8f9d028 -->

<!-- START_768efb1fcbf451b474c23f996126db6d -->
## Invoice Statement IUGU

Invoice Statement | Exemplo: api/v1/financial/invoiceStatement

> Example request:

```bash
curl -X GET "http://localhost/api/v1/financial/invoiceStatement" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/financial/invoiceStatement",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/financial/invoiceStatement`

`HEAD api/v1/financial/invoiceStatement`


<!-- END_768efb1fcbf451b474c23f996126db6d -->

#Intermediator
<!-- START_2b96aba35a93cd398e8c8d1eb2a6287b -->
## Search Intermediator

Search a intermediator | Exemplo: api/v1/intermediator/$idInt

> Example request:

```bash
curl -X GET "http://localhost/api/v1/intermediator/{idInt}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/intermediator/{idInt}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/intermediator/{idInt}`

`HEAD api/v1/intermediator/{idInt}`


<!-- END_2b96aba35a93cd398e8c8d1eb2a6287b -->

<!-- START_bf92705f0471c7a95634a57d4e2240c0 -->
## Create Intermediator

Create a intermediator | Exemplo: api/v1/intermediator/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/intermediator/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/intermediator/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/intermediator/create`


<!-- END_bf92705f0471c7a95634a57d4e2240c0 -->

<!-- START_d6c140324e1c82d3fc6258ff47793bbd -->
## Update Intermediator

Update a intermediator | Exemplo: api/v1/intermediator/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/intermediator/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/intermediator/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/intermediator/update`


<!-- END_d6c140324e1c82d3fc6258ff47793bbd -->

<!-- START_b5c245f28f69c725f41029c6de094522 -->
## Remover Intermediator

Remover a intermediator | Exemplo: api/v1/intermediator/delete/$idInt

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/intermediator/delete/{idInt}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/intermediator/delete/{idInt}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/intermediator/delete/{idInt}`


<!-- END_b5c245f28f69c725f41029c6de094522 -->

#IntermediatorMethod
<!-- START_2dd768a75a3556d300168dc137d6683e -->
## Search Intermediator Method

Search Intermediator Method | Exemplo: api/v1/intermediatorMethod/$idImt

> Example request:

```bash
curl -X GET "http://localhost/api/v1/intermediatorMethod/{idImt}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/intermediatorMethod/{idImt}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "imt_intermediator_id": 1,
    "imt_title": "Cartão Crédito",
    "imt_type": "creditcard",
    "imt_fixed": "0.70",
    "imt_variable": "2.51"
}
```

### HTTP Request
`GET api/v1/intermediatorMethod/{idImt}`

`HEAD api/v1/intermediatorMethod/{idImt}`


<!-- END_2dd768a75a3556d300168dc137d6683e -->

<!-- START_a392277ae45ce2596e44c03ab0186811 -->
## Create Intermediator Method

Create Intermediator Method | Exemplo: api/v1/intermediatorMethod/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/intermediatorMethod/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/intermediatorMethod/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/intermediatorMethod/create`


<!-- END_a392277ae45ce2596e44c03ab0186811 -->

<!-- START_56dcd6f94a6da16d7ae24b1bd0faa4e4 -->
## Update Intermediator Method

Update Intermediator Method | Exemplo: api/v1/intermediatorMethod/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/intermediatorMethod/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/intermediatorMethod/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/intermediatorMethod/update`


<!-- END_56dcd6f94a6da16d7ae24b1bd0faa4e4 -->

<!-- START_3f8e20a0e452bfa33f4f2ecea62a80fb -->
## Remove Intermediator Method

Remove Intermediator Method | Exemplo: api/v1/intermediatorMethod/delete/$idImt

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/intermediatorMethod/delete/{idImt}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/intermediatorMethod/delete/{idImt}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/intermediatorMethod/delete/{idImt}`


<!-- END_3f8e20a0e452bfa33f4f2ecea62a80fb -->

#Invoice
<!-- START_b9cc5f70da9eb05fe28b329b3d5fb284 -->
## Generate Invoice pelo IUGU

Generate a invoice | Example: api/v1/invoice/create/$idPgm

> Example request:

```bash
curl -X GET "http://localhost/api/v1/invoice/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/invoice/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/invoice/create`

`HEAD api/v1/invoice/create`


<!-- END_b9cc5f70da9eb05fe28b329b3d5fb284 -->

<!-- START_518d4d0c7adc74a37168d6fd38a0a74f -->
## Search Invoice

Search a invoice | Example: api/v1/invoice/list/

> Example request:

```bash
curl -X GET "http://localhost/api/v1/invoice/list" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/invoice/list",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/invoice/list`

`HEAD api/v1/invoice/list`


<!-- END_518d4d0c7adc74a37168d6fd38a0a74f -->

<!-- START_5e58299571a105951a507b73fedbc9ca -->
## Capturar Invoice

Capturar a invoice | Example: api/v1/invoice/capture/$idInvoice

> Example request:

```bash
curl -X GET "http://localhost/api/v1/invoice/capture/{idInvoice}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/invoice/capture/{idInvoice}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/invoice/capture/{idInvoice}`

`HEAD api/v1/invoice/capture/{idInvoice}`


<!-- END_5e58299571a105951a507b73fedbc9ca -->

<!-- START_f6ff3830ecf6ebed207ea7b9a3c7b16f -->
## Repay Invoice

Repay a invoice | Example: api/v1/invoice/refund/$idInvoice

> Example request:

```bash
curl -X GET "http://localhost/api/v1/invoice/refund/{idInvoice}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/invoice/refund/{idInvoice}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/invoice/refund/{idInvoice}`

`HEAD api/v1/invoice/refund/{idInvoice}`


<!-- END_f6ff3830ecf6ebed207ea7b9a3c7b16f -->

<!-- START_3968766f6547b99710d772a6ff4afd10 -->
## Cancel Invoice

Cancel a invoice | Example: api/v1/invoice/cancel/$idInvoice

> Example request:

```bash
curl -X GET "http://localhost/api/v1/invoice/cancel/{idInvoice}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/invoice/cancel/{idInvoice}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/invoice/cancel/{idInvoice}`

`HEAD api/v1/invoice/cancel/{idInvoice}`


<!-- END_3968766f6547b99710d772a6ff4afd10 -->

<!-- START_6593a1eaffad21ecf8b38ea39ff812bc -->
## Generate Second Way Invoice

Generate a second way invoice | Example: api/v1/invoice/generateSecondWay/$idInvoice

> Example request:

```bash
curl -X GET "http://localhost/api/v1/invoice/generateSecondWay/{idInvoice}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/invoice/generateSecondWay/{idInvoice}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/invoice/generateSecondWay/{idInvoice}`

`HEAD api/v1/invoice/generateSecondWay/{idInvoice}`


<!-- END_6593a1eaffad21ecf8b38ea39ff812bc -->

<!-- START_94dc2ec1abac9af3b2615bc927282143 -->
## Search Invoice

Search a invoice | Example: api/v1/invoice/search/$idInvoice

> Example request:

```bash
curl -X GET "http://localhost/api/v1/invoice/search/{idInvoice}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/invoice/search/{idInvoice}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/invoice/search/{idInvoice}`

`HEAD api/v1/invoice/search/{idInvoice}`


<!-- END_94dc2ec1abac9af3b2615bc927282143 -->

<!-- START_73bfd1ac522677d80b5441e2a9a3fd05 -->
## Send Email Invoice

Send a email invoice | Example: api/v1/invoice/sendEmail/$idInvoice/$to

> Example request:

```bash
curl -X GET "http://localhost/api/v1/invoice/sendEmail/{idInvoice}/{to}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/invoice/sendEmail/{idInvoice}/{to}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/invoice/sendEmail/{idInvoice}/{to}`

`HEAD api/v1/invoice/sendEmail/{idInvoice}/{to}`


<!-- END_73bfd1ac522677d80b5441e2a9a3fd05 -->

#Item
<!-- START_6c668e0c76a37c8c533ce1cbd57f5be9 -->
## Search Item

Search Item | Exemplo: api/v1/item/$idOit

> Example request:

```bash
curl -X GET "http://localhost/api/v1/item/{idOit}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/item/{idOit}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "oit_pedido": 1,
    "oit_titulo": "Reserva Piso Inferior Mesa 3",
    "oit_tipo": "reservas",
    "oit_tipo_id": 848490,
    "oit_quantidade": 1,
    "oit_valor": "100.00"
}
```

### HTTP Request
`GET api/v1/item/{idOit}`

`HEAD api/v1/item/{idOit}`


<!-- END_6c668e0c76a37c8c533ce1cbd57f5be9 -->

<!-- START_f581f5c26bb97a508fa71f985a5a1d55 -->
## Create Item

Create Item | Exemplo: api/v1/item/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/item/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/item/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/item/create`


<!-- END_f581f5c26bb97a508fa71f985a5a1d55 -->

<!-- START_39ac5fc0c8de4965b3db9a05f2e0998e -->
## Update Item

Update Item | Exemplo: api/v1/item/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/item/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/item/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/item/update`


<!-- END_39ac5fc0c8de4965b3db9a05f2e0998e -->

<!-- START_eb629f70320f5d264b78f923d4071aee -->
## Remover Item

Remover Item | Exemplo: api/v1/item/delete/$idOit

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/item/delete/{idOit}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/item/delete/{idOit}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/item/delete/{idOit}`


<!-- END_eb629f70320f5d264b78f923d4071aee -->

#Order
<!-- START_05fff884b6129629b310db52ef026ec1 -->
## Search Order

Search a order | Exemplo: api/v1/orders/1

> Example request:

```bash
curl -X GET "http://localhost/api/v1/order/{idOrd}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/order/{idOrd}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/order/{idOrd}`

`HEAD api/v1/order/{idOrd}`


<!-- END_05fff884b6129629b310db52ef026ec1 -->

<!-- START_262c865f050dbacf61b46826616ffa9c -->
## Create Order

Create a order | Exemplo: api/v1/itens/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/order/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/order/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/order/create`


<!-- END_262c865f050dbacf61b46826616ffa9c -->

<!-- START_a60ba0cfb8a0105aabf31c0df624d71d -->
## Update Order

Update a Order | Exemplo: api/v1/orders/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/order/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/order/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/order/update`


<!-- END_a60ba0cfb8a0105aabf31c0df624d71d -->

<!-- START_9d6dfa5f3a7712313bd8f2544294b7dc -->
## Remove Order

Remove Order | Exemplo: api/v1/orders/delete/1

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/order/delete/{idOrd}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/order/delete/{idOrd}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/order/delete/{idOrd}`


<!-- END_9d6dfa5f3a7712313bd8f2544294b7dc -->

#Payment
<!-- START_129beed18021e943cc0307e09faa9589 -->
## Search Payment

Search Payment | Example: api/v1/payment/$idPgm

> Example request:

```bash
curl -X GET "http://localhost/api/v1/payment/{idPgm}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/payment/{idPgm}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "pgm_local": 2,
    "pgm_carteira": 501,
    "pgm_pedido": 1,
    "pgm_valor": "3.00",
    "pgm_parcelas": 1,
    "pgm_parcelas_pagas": 0,
    "pgm_status": "",
    "pgm_pagador_nome": "Leonardo Filipe Bento",
    "pgm_pagador_email": "lonok@msn.com",
    "pgm_pagador_celular": "47996546929",
    "pgm_pagador_cpf": "04314101946",
    "pgm_pagador_genero": "Masculino",
    "pgm_pagador_nascimento": "0000-00-00",
    "pgm_pagador_razao": "",
    "pgm_pagador_cnpj": "",
    "pgm_metodo": "boleto",
    "pgm_intermediario": "iugu",
    "pgm_intermediario_code": "CECB9C843C88406F9667D1F8191F27EA",
    "pgm_intermediario_status": "",
    "pgm_intermediario_taxa": "0.00",
    "pgm_intermediario_fixo": "1.98",
    "pgm_intermediario_variavel": "0.00",
    "pgm_intermediario_total": "0.00",
    "pgm_intermediario_disponivel": "0.00",
    "pgm_boleto_url": "https:\/\/faturas.iugu.com\/cecb9c84-3c88-406f-9667-d1f8191f27ea-baac?bs=true",
    "pgm_boleto_digitavel": "2379338128 50003844920 41000050801 7 72310000000300",
    "pgm_cartao_metodo": "CrÃ©dit",
    "pgm_cartao_bandeira": "",
    "pgm_cartao_numero": "",
    "pgm_cartao_mes": "",
    "pgm_cartao_ano": 0,
    "pgm_cartao_nome": "",
    "pgm_cartao_codigo": 0,
    "pgm_cartao_recobrancas": 0,
    "pgm_endereco_cep": "88302060",
    "pgm_endereco_cidade": 4208203,
    "pgm_endereco_logradouro": "Rua Jose Raimundo De Oliveira",
    "pgm_endereco_numero": "129",
    "pgm_endereco_bairro": "Centro",
    "pgm_endereco_complemento": "Casa",
    "pgm_comissao_custo": "0.00",
    "pgm_comissao_taxa": "0.00",
    "pgm_comissao_fixo": "8.02",
    "pgm_comissao_variavel": "0.00",
    "pgm_comissao_total": "0.00",
    "pgm_comissao_paga": "",
    "pgm_criado_em": "2017-07-25 18:11:00",
    "pgm_pago_em": "0000-00-00 00:00:00",
    "pgm_cliente_taxa": "0.00",
    "pgm_cliente_liquido": "0.00",
    "pgm_disponivel_futuro": "3.00",
    "pgm_disponivel_liberado": "0.00",
    "pgm_disponivel_intermediario": "0.00",
    "pgm_disponivel_empresa": "0.00",
    "pgm_disponivel_cliente": "0.00"
}
```

### HTTP Request
`GET api/v1/payment/{idPgm}`

`HEAD api/v1/payment/{idPgm}`


<!-- END_129beed18021e943cc0307e09faa9589 -->

<!-- START_79e940e840c2f261662c5de93a3d5326 -->
## Create Payment

Create Payment | Example: api/v1/payment/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/payment/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/payment/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/payment/create`


<!-- END_79e940e840c2f261662c5de93a3d5326 -->

<!-- START_d1dfbece2581639fa570bb1710bd46c9 -->
## Update Payment

Update Payment | Example: api/v1/payment/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/payment/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/payment/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/payment/update`


<!-- END_d1dfbece2581639fa570bb1710bd46c9 -->

<!-- START_bafe42541ca9860adceda3b971d73fd1 -->
## Remove Payment

Remove Payment | Example: api/v1/payment/delete/$idPrc

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/payment/delete/{idRcb}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/payment/delete/{idRcb}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/payment/delete/{idRcb}`


<!-- END_bafe42541ca9860adceda3b971d73fd1 -->

<!-- START_bba748ae64b505774962ad9ee23f64b2 -->
## Generate Pay per Ticket

Generate a ticket | Example: api/v1/payment/ticket/$idPgm

> Example request:

```bash
curl -X GET "http://localhost/api/v1/payment/ticket/{idPgm}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/payment/ticket/{idPgm}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/payment/ticket/{idPgm}`

`HEAD api/v1/payment/ticket/{idPgm}`


<!-- END_bba748ae64b505774962ad9ee23f64b2 -->

<!-- START_046d0c44ce1cf418d2cdc91e0bd1f8c9 -->
## Generate payment by Card

Generate a ticket | Example: api/v1/payment/card/$idPgm

> Example request:

```bash
curl -X GET "http://localhost/api/v1/payment/card/{idPgm}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/payment/card/{idPgm}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/payment/card/{idPgm}`

`HEAD api/v1/payment/card/{idPgm}`


<!-- END_046d0c44ce1cf418d2cdc91e0bd1f8c9 -->

<!-- START_5345f5fbe8001484dcb75f455aac7176 -->
## Generate Pagament per ticket legal person

Generate a pagament | Example: api/v1/payment/ticket/legalPerson/$idPgm

> Example request:

```bash
curl -X GET "http://localhost/api/v1/payment/ticket/legalPerson/{idPgm}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/payment/ticket/legalPerson/{idPgm}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/payment/ticket/legalPerson/{idPgm}`

`HEAD api/v1/payment/ticket/legalPerson/{idPgm}`


<!-- END_5345f5fbe8001484dcb75f455aac7176 -->

<!-- START_c8687a96254255a8508e98bea6f2a313 -->
## Set address per ticket legal person

Set a address for ticket | Example: api/v1/payment/ticket/setAddress/$idPgm/$idTransaction

> Example request:

```bash
curl -X GET "http://localhost/api/v1/payment/ticket/setTicketAddress/{idPgm}/{idTransaction}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/payment/ticket/setTicketAddress/{idPgm}/{idTransaction}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/payment/ticket/setTicketAddress/{idPgm}/{idTransaction}`

`HEAD api/v1/payment/ticket/setTicketAddress/{idPgm}/{idTransaction}`


<!-- END_c8687a96254255a8508e98bea6f2a313 -->

#Receivable
<!-- START_03ef1c65a7836b616aafb18ae8730d9c -->
## Search Receivable

Search Receivable | Example: api/v1/payment/$idRcb

> Example request:

```bash
curl -X GET "http://localhost/api/v1/receivable/{idRcb}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/receivable/{idRcb}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/receivable/{idRcb}`

`HEAD api/v1/receivable/{idRcb}`


<!-- END_03ef1c65a7836b616aafb18ae8730d9c -->

<!-- START_a0590eacccd44767bd8e28ba4e89628e -->
## Create Receivable

Create Receivable | Example: api/v1/receivable/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/receivable/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/receivable/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/receivable/create`


<!-- END_a0590eacccd44767bd8e28ba4e89628e -->

<!-- START_08724e3692b3123ae49a0258270ccf3b -->
## Update Receivable

Update Receivable | Example: api/v1/receivable/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/receivable/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/receivable/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/receivable/update`


<!-- END_08724e3692b3123ae49a0258270ccf3b -->

<!-- START_7758dce119cd7f62915a146715a56e1e -->
## Remove Receivable

Remove Receivable | Example: api/v1/receivable/delete/$idPrc

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/receivable/delete/{idRcb}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/receivable/delete/{idRcb}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/receivable/delete/{idRcb}`


<!-- END_7758dce119cd7f62915a146715a56e1e -->

#Transaction
<!-- START_9fbdd347b65b46077f2f706df9b5d98b -->
## Update Transaction GerenciaNet

Update a transaction | Example: api/v1/transaction/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/transaction/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transaction/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/transaction/create`


<!-- END_9fbdd347b65b46077f2f706df9b5d98b -->

<!-- START_3802ac0326ba58d174117432372dad4f -->
## Update Transaction GerenciaNet

Update a transaction | Example: api/v1/transaction/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/transaction/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transaction/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/transaction/update`


<!-- END_3802ac0326ba58d174117432372dad4f -->

<!-- START_af03eb5e92a9a5cb5f2cf04cd0d0ca8a -->
## Consult Notification Transaction GerenciaNet

Consult a notification | Example: api/v1/transaction/consult/$idTransaction

> Example request:

```bash
curl -X GET "http://localhost/api/v1/transaction/consult" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transaction/consult",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/transaction/consult`

`HEAD api/v1/transaction/consult`


<!-- END_af03eb5e92a9a5cb5f2cf04cd0d0ca8a -->

<!-- START_3d0879aa623b290b55411dde0a56ce59 -->
## Detail Transaction GerenciaNet

Detail a transaction | Example: api/v1/transaction/detail/$idTransaction

> Example request:

```bash
curl -X GET "http://localhost/api/v1/transaction/detail/{idTransaction}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transaction/detail/{idTransaction}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/transaction/detail/{idTransaction}`

`HEAD api/v1/transaction/detail/{idTransaction}`


<!-- END_3d0879aa623b290b55411dde0a56ce59 -->

<!-- START_feaeb5787fb88e07f4a042342c5808ec -->
## Cancel Transaction GerenciaNet

Cancel a transaction | Example: api/v1/transaction/cancel/$idTransaction

> Example request:

```bash
curl -X GET "http://localhost/api/v1/transaction/cancel/{idTransaction}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transaction/cancel/{idTransaction}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/transaction/cancel/{idTransaction}`

`HEAD api/v1/transaction/cancel/{idTransaction}`


<!-- END_feaeb5787fb88e07f4a042342c5808ec -->

#Transfer
<!-- START_e1d7ed8a93adb454e553488b2f887e4e -->
## List transfer IUGU

List a transfer | Example: api/v1/transfer/list/

> Example request:

```bash
curl -X GET "http://localhost/api/v1/transfer/list" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transfer/list",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/transfer/list`

`HEAD api/v1/transfer/list`


<!-- END_e1d7ed8a93adb454e553488b2f887e4e -->

<!-- START_80dc877bd220c9ff51b59f265686c55a -->
## List Bank Transfer IUGU

List bank transfer | Example: api/v1/transfer/listBankTransfers/

> Example request:

```bash
curl -X GET "http://localhost/api/v1/transfer/listBankTransfers" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transfer/listBankTransfers",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/transfer/listBankTransfers`

`HEAD api/v1/transfer/listBankTransfers`


<!-- END_80dc877bd220c9ff51b59f265686c55a -->

<!-- START_9084bf82033fd700972154d051eb8680 -->
## Search Bank Transfer IUGU

Search a bank transfer | Example: api/v1/transfer/searchBankTransfer/

> Example request:

```bash
curl -X GET "http://localhost/api/v1/transfer/searchBankTransfer" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transfer/searchBankTransfer",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/transfer/searchBankTransfer`

`HEAD api/v1/transfer/searchBankTransfer`


<!-- END_9084bf82033fd700972154d051eb8680 -->

<!-- START_5b30cb4debeccebd82160740db97a5b8 -->
## Generate Transfer IUGU

Generate a transfer | Example: api/v1/transfer/transfer/$idAccount/$value

> Example request:

```bash
curl -X GET "http://localhost/api/v1/transfer/transfer/{idAccount}/{value}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transfer/transfer/{idAccount}/{value}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/transfer/transfer/{idAccount}/{value}`

`HEAD api/v1/transfer/transfer/{idAccount}/{value}`


<!-- END_5b30cb4debeccebd82160740db97a5b8 -->

<!-- START_7f3a731657b77398859e7f821fbfb96f -->
## Search transfer IUGU

Search transfer | Example: api/v1/transfer/search/$idTransfer

> Example request:

```bash
curl -X GET "http://localhost/api/v1/transfer/search/{idTransfer}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/transfer/search/{idTransfer}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/transfer/search/{idTransfer}`

`HEAD api/v1/transfer/search/{idTransfer}`


<!-- END_7f3a731657b77398859e7f821fbfb96f -->

#Wallet
<!-- START_26746381cf12fe3560fbd68b34160e21 -->
## Search Wallet

Search a wallet | Exemplo: api/v1/wallet/$idWal

> Example request:

```bash
curl -X GET "http://localhost/api/v1/wallet/{idWal}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/wallet/{idWal}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/wallet/{idWal}`

`HEAD api/v1/wallet/{idWal}`


<!-- END_26746381cf12fe3560fbd68b34160e21 -->

<!-- START_5b171233e93edba36ff4bba81a0103f4 -->
## Create Wallet

Create a wallet | Exemplo: api/v1/wallet/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/wallet/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/wallet/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/wallet/create`


<!-- END_5b171233e93edba36ff4bba81a0103f4 -->

<!-- START_618b5c971bcf257219ab33c52174f8a2 -->
## Update Wallet

Update a wallet | Exemplo: api/v1/wallet/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/wallet/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/wallet/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/wallet/update`


<!-- END_618b5c971bcf257219ab33c52174f8a2 -->

<!-- START_85a94a6273359f94e94236ba67091070 -->
## Delete Wallet

Delete Wallet | Exemplo: api/v1/wallet/delete/$idWal

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/wallet/delete/{idWal}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/wallet/delete/{idWal}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/wallet/delete/{idWal}`


<!-- END_85a94a6273359f94e94236ba67091070 -->

#Withdrawal
<!-- START_430b5f0d0723e55683a308295d10a353 -->
## Search Withdrawal

Search a withdrawal | Exemplo: api/v1/withdrawal/$idSaq

> Example request:

```bash
curl -X GET "http://localhost/api/v1/withdrawal/{idSaq}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/withdrawal/{idSaq}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/withdrawal/{idSaq}`

`HEAD api/v1/withdrawal/{idSaq}`


<!-- END_430b5f0d0723e55683a308295d10a353 -->

<!-- START_d07528525e57fd85d8d202dbdcbe41fe -->
## Withdraw of Withdrawal

Withdraw of withdrawal | Exemplo: api/v1/withdrawal/withdraw/$idSaq

> Example request:

```bash
curl -X GET "http://localhost/api/v1/withdrawal/withdraw/{idSaq}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/withdrawal/withdraw/{idSaq}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/withdrawal/withdraw/{idSaq}`

`HEAD api/v1/withdrawal/withdraw/{idSaq}`


<!-- END_d07528525e57fd85d8d202dbdcbe41fe -->

<!-- START_4491a48953a3fff1da7d0d1d0208f7ca -->
## Update Withdrawal

Update a withdrawal | Exemplo: api/v1/withdrawal/update

> Example request:

```bash
curl -X POST "http://localhost/api/v1/withdrawal/update" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/withdrawal/update",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/withdrawal/update`


<!-- END_4491a48953a3fff1da7d0d1d0208f7ca -->

<!-- START_36c359174914f1de26235d95e7b96a67 -->
## Create Withdrawal

Create a withdrawal | Exemplo: api/v1/withdrawal/create

> Example request:

```bash
curl -X POST "http://localhost/api/v1/withdrawal/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/withdrawal/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/withdrawal/create`


<!-- END_36c359174914f1de26235d95e7b96a67 -->

<!-- START_87657f24a912fef4f3163e46a510b9f1 -->
## Remover Withdrawal

Remover a withdrawal | Exemplo: api/v1/withdrawal/delete/$idSaq

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/withdrawal/delete/{idSaq}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/withdrawal/delete/{idSaq}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/withdrawal/delete/{idSaq}`


<!-- END_87657f24a912fef4f3163e46a510b9f1 -->

