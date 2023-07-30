const mysql = require('mysql');
const conn = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "project",
    port: 3307
});
conn.connect((err) => {
    if (err) throw err;
    console.log("connected successfuly!");

})
module.exports = conn