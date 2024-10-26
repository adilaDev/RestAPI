# REST API Documentation

## Introduction
This documentation provides an overview of how to use the REST API services. You can interact with the API using https methods such as `GET`, `POST`, `PUT`, and `DELETE`.

## Authentication
The API restricts access based on your IP address. Only authorized IPs can send `POST`, `PUT`, and `DELETE` requests.

**Allowed IPs:**
- `127.0.0.1`
- `192.168.1.7`
- `110.138.91.114`

## Available Endpoints

| Endpoint                                           | Method | Description                             |
| -------------------------------------------------- | ------ | --------------------------------------- |
| `/api?type=get&db_name=your_db&tb_name=your_table` | GET    | Retrieve data from a specific table.    |
| `/api?type=insert`                                 | POST   | Insert data into a specific table.      |
| `/api?type=update`                                 | POST   | Update data in a specific table.        |
| `/api?type=delete`                                 | POST   | Delete data from a specific table.      |
| `/api?type=list_db`                                | GET    | List all available databases.           |
| `/api?type=list_tb&db_name=your_db`                | GET    | List all tables in a specific database. |

## API Examples

### GET Request Example
Use the following cURL command to retrieve data: [Demo API](https://yourdomain.com/restapi/api?type=get&db_name=your_db&tb_name=your_table)

```bash
curl -X GET "https://yourdomain.com/restapi/api?type=get&db_name=your_db&tb_name=your_table"
```

### POST Request Example
Use the following cURL command to insert data:
```bash
curl -X POST -d "field1=value1&field2=value2" "https://yourdomain.com/restapi/api?type=insert&db_name=your_db&tb_name=your_table"
```

### PUT Request Example
Use the following cURL command to update data:
```bash
curl -X PUT -d "field1=new_value1&field2=new_value2" "https://yourdomain.com/restapi/api?type=update&db_name=your_db&tb_name=your_table"
```
### DELETE Request Example
Use the following cURL command to delete data:
```bash
curl -X DELETE -d "id=your_id" "https://yourdomain.com/restapi/api?type=delete&db_name=your_db&tb_name=your_table"
```
### Using Fetch API
The following JavaScript code demonstrates how to interact with the API using the Fetch API:
```bash
fetch("https://yourdomain.com/restapi/api/endpoint", {
    method: "GET",
    headers: {
        "Accept": "application/json"
    }
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

