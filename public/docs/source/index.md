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

#Carteiras
<!-- START_cea62ca7982e1be73d980f76a692b4ca -->
## Remover Carteira

Remover Carteira | Exemplo: smart/api/v1/carteiras/delete/1

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/carteiras/delete/{wal_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/carteiras/delete/{wal_id}",
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
`DELETE api/v1/carteiras/delete/{wal_id}`


<!-- END_cea62ca7982e1be73d980f76a692b4ca -->

<!-- START_6cbc27df0720bc700a8e09ab8003128c -->
## Criar Carteira

Criar Carteira | Exemplo: smart/api/v1/carteiras/criar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/carteiras/criar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/carteiras/criar",
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
`POST api/v1/carteiras/criar`


<!-- END_6cbc27df0720bc700a8e09ab8003128c -->

<!-- START_0a070034cc2b0a4c7c95fb940ceda262 -->
## Atualizar Carteira

Atualizar Carteira | Exemplo: smart/api/v1/carteiras/atualizar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/carteiras/atualizar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/carteiras/atualizar",
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
`POST api/v1/carteiras/atualizar`


<!-- END_0a070034cc2b0a4c7c95fb940ceda262 -->

<!-- START_c10b09fbb08dcea2b1f9c0cff90b48b0 -->
## Buscar Carteira

Buscar Carteira | Exemplo: smart/api/v1/carteiras/1

> Example request:

```bash
curl -X GET "http://localhost/api/v1/carteiras/{wal_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/carteiras/{wal_id}",
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
    "error": "Tente nvomante! Estamos com problemas entre em contato com a SmartClick."
}
```

### HTTP Request
`GET api/v1/carteiras/{wal_id}`

`HEAD api/v1/carteiras/{wal_id}`


<!-- END_c10b09fbb08dcea2b1f9c0cff90b48b0 -->

#Dividas
<!-- START_011e7a845ccb29fed73909507a425a6e -->
## Remover Divida

Remover Divida | Exemplo: smart/api/v1/dividas/delete/1

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/dividas/delete/{pgm_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/dividas/delete/{pgm_id}",
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
`DELETE api/v1/dividas/delete/{pgm_id}`


<!-- END_011e7a845ccb29fed73909507a425a6e -->

<!-- START_6c5c2eca66b3180edb9081cfb12b674e -->
## Criar Divida

Criar Divida | Exemplo: smart/api/v1/dividas/criar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/dividas/criar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/dividas/criar",
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
`POST api/v1/dividas/criar`


<!-- END_6c5c2eca66b3180edb9081cfb12b674e -->

<!-- START_92a4a6b28663948b38816aee707c473a -->
## Atualizar Divida

Atualizar Divida | Exemplo: smart/api/v1/dividas/criar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/dividas/atualizar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/dividas/atualizar",
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
`POST api/v1/dividas/atualizar`


<!-- END_92a4a6b28663948b38816aee707c473a -->

<!-- START_86c02aa6e13cb339b31d957707fb4af4 -->
## Buscar Divida

Buscar Divida | Exemplo: smart/api/v1/dividas/1

> Example request:

```bash
curl -X GET "http://localhost/api/v1/dividas/{pgm_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/dividas/{pgm_id}",
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
    "error": "Tente nvomante! Estamos com problemas entre em contato com a SmartClick."
}
```

### HTTP Request
`GET api/v1/dividas/{pgm_id}`

`HEAD api/v1/dividas/{pgm_id}`


<!-- END_86c02aa6e13cb339b31d957707fb4af4 -->

#Itens
<!-- START_c256b468f2bcebf1e525735b35fa1cb7 -->
## Remover Iten

Remover Iten | Exemplo: smart/api/v1/itens/delete/1

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/itens/delete/{oit_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/itens/delete/{oit_id}",
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
`DELETE api/v1/itens/delete/{oit_id}`


<!-- END_c256b468f2bcebf1e525735b35fa1cb7 -->

<!-- START_25a1066ba7079ca4942d4410baf28e5f -->
## Criar Iten

Criar Iten | Exemplo: smart/api/v1/itens/criar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/itens/criar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/itens/criar",
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
`POST api/v1/itens/criar`


<!-- END_25a1066ba7079ca4942d4410baf28e5f -->

<!-- START_0a3d3f025719d99f79fb74c202a67673 -->
## Atualizar Iten

Atualizar Iten | Exemplo: smart/api/v1/itens/atualizar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/itens/atualizar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/itens/atualizar",
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
`POST api/v1/itens/atualizar`


<!-- END_0a3d3f025719d99f79fb74c202a67673 -->

<!-- START_23204f80569f53f676177070f01642ba -->
## Buscar Iten

Buscar Iten | Exemplo: smart/api/v1/itens/1

> Example request:

```bash
curl -X GET "http://localhost/api/v1/itens/{oit_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/itens/{oit_id}",
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
    "error": "Tente nvomante! Estamos com problemas entre em contato com a SmartClick."
}
```

### HTTP Request
`GET api/v1/itens/{oit_id}`

`HEAD api/v1/itens/{oit_id}`


<!-- END_23204f80569f53f676177070f01642ba -->

#Pagamento
<!-- START_05054dfcd79fd4ac1ef85b3c1249ab44 -->
## Gerar Boleto

Gerar um boleto | Exemplo: smart/api/v1/pagamento/boleto/$pgm_id

> Example request:

```bash
curl -X GET "http://localhost/api/v1/pagamento/boleto/{pgm_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/pagamento/boleto/{pgm_id}",
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
    "error": "Tente nvomante! Estamos com problemas entre em contato com a SmartClick."
}
```

### HTTP Request
`GET api/v1/pagamento/boleto/{pgm_id}`

`HEAD api/v1/pagamento/boleto/{pgm_id}`


<!-- END_05054dfcd79fd4ac1ef85b3c1249ab44 -->

#Pedidos
<!-- START_7648e31fac9b2d2bedbb6d1a6203d268 -->
## Remover Iten

Remover Iten | Exemplo: smart/api/v1/itens/delete/1

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/pedidos/delete/{ord_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/pedidos/delete/{ord_id}",
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
`DELETE api/v1/pedidos/delete/{ord_id}`


<!-- END_7648e31fac9b2d2bedbb6d1a6203d268 -->

<!-- START_528eb13c3c5c55862392081fe57e8f1e -->
## Criar Pedido

Criar Pedido | Exemplo: api/v1/itens/criar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/pedidos/criar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/pedidos/criar",
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
`POST api/v1/pedidos/criar`


<!-- END_528eb13c3c5c55862392081fe57e8f1e -->

<!-- START_4901237e8582e0ebfd8f8d08527c3dfc -->
## Atualizar Pedido

Atualizar Pedido | Exemplo: smart/api/v1/pedidos/atualizar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/pedidos/atualizar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/pedidos/atualizar",
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
`POST api/v1/pedidos/atualizar`


<!-- END_4901237e8582e0ebfd8f8d08527c3dfc -->

<!-- START_6f1b21af8b5dbcef1979ced87ab82bc4 -->
## Buscar Pedido

Buscar Pedido | Exemplo: smart/api/v1/pedidos/1

> Example request:

```bash
curl -X GET "http://localhost/api/v1/pedidos/{ord_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/pedidos/{ord_id}",
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
    "error": "Tente nvomante! Estamos com problemas entre em contato com a SmartClick."
}
```

### HTTP Request
`GET api/v1/pedidos/{ord_id}`

`HEAD api/v1/pedidos/{ord_id}`


<!-- END_6f1b21af8b5dbcef1979ced87ab82bc4 -->

#Recebimentos
<!-- START_aafacb1c8c49dc08cf050247d4fc6a69 -->
## Remover Recebimento

Remover Recebimento | Exemplo: smart/api/v1/recebimentos/delete/1

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/recebimentos/delete/{prc_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recebimentos/delete/{prc_id}",
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
`DELETE api/v1/recebimentos/delete/{prc_id}`


<!-- END_aafacb1c8c49dc08cf050247d4fc6a69 -->

<!-- START_9bd2cbab40b4bf9843aca905f60217c6 -->
## Criar Recebimento

Criar Recebimento | Exemplo: smart/api/v1/recebimentos/criar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/recebimentos/criar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recebimentos/criar",
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
`POST api/v1/recebimentos/criar`


<!-- END_9bd2cbab40b4bf9843aca905f60217c6 -->

<!-- START_376fb5c33a771879231c881b5f493ba7 -->
## Atualizar Recebimento

Atualizar Recebimento | Exemplo: smart/api/v1/recebimentos/atualizar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/recebimentos/atualizar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recebimentos/atualizar",
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
`POST api/v1/recebimentos/atualizar`


<!-- END_376fb5c33a771879231c881b5f493ba7 -->

<!-- START_e2e48a7766f112a09f6d269f2ecec6fe -->
## Buscar Recebimento

Buscar Recebimento | Exemplo: smart/api/v1/recebimentos/1

> Example request:

```bash
curl -X GET "http://localhost/api/v1/recebimentos/{prc_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/recebimentos/{prc_id}",
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
    "error": "Tente nvomante! Estamos com problemas entre em contato com a SmartClick."
}
```

### HTTP Request
`GET api/v1/recebimentos/{prc_id}`

`HEAD api/v1/recebimentos/{prc_id}`


<!-- END_e2e48a7766f112a09f6d269f2ecec6fe -->

#Saques
<!-- START_7a5caa7fd906a954944e54edd37089ef -->
## Remover Saque

Remover Saque | Exemplo: smart/api/v1/saques/delete/1

> Example request:

```bash
curl -X DELETE "http://localhost/api/v1/saques/delete/{saq_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/saques/delete/{saq_id}",
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
`DELETE api/v1/saques/delete/{saq_id}`


<!-- END_7a5caa7fd906a954944e54edd37089ef -->

<!-- START_d4ab20b219378704f7ba95e73b449eb9 -->
## Pedido de Saque

Pedido de Saque | Exemplo: smart/api/v1/saques/sacar/1

> Example request:

```bash
curl -X GET "http://localhost/api/v1/saques/sacar/{saq_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/saques/sacar/{saq_id}",
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
    "error": "Tente nvomante! Estamos com problemas entre em contato com a SmartClick."
}
```

### HTTP Request
`GET api/v1/saques/sacar/{saq_id}`

`HEAD api/v1/saques/sacar/{saq_id}`


<!-- END_d4ab20b219378704f7ba95e73b449eb9 -->

<!-- START_95e2bf9a049f1d1e2aaf6c18286af591 -->
## Atualizar Saque

Atualizar Saque | Exemplo: smart/api/v1/saques/atualizar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/saques/atualizar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/saques/atualizar",
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
`POST api/v1/saques/atualizar`


<!-- END_95e2bf9a049f1d1e2aaf6c18286af591 -->

<!-- START_b3a7809bed7f4eaa84adcb82181f1716 -->
## Criar Saque

Criar Saque | Exemplo: smart/api/v1/saques/criar

> Example request:

```bash
curl -X POST "http://localhost/api/v1/saques/criar" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/saques/criar",
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
`POST api/v1/saques/criar`


<!-- END_b3a7809bed7f4eaa84adcb82181f1716 -->

<!-- START_605c90fad77a06bdad22175cc8f30acf -->
## Buscar Saque

Buscar Saque | Exemplo: smart/api/v1/saques/1

> Example request:

```bash
curl -X GET "http://localhost/api/v1/saques/{saq_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/v1/saques/{saq_id}",
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
    "error": "Tente nvomante! Estamos com problemas entre em contato com a SmartClick."
}
```

### HTTP Request
`GET api/v1/saques/{saq_id}`

`HEAD api/v1/saques/{saq_id}`


<!-- END_605c90fad77a06bdad22175cc8f30acf -->

