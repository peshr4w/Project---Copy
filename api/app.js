const express = require("express");
const conn = require("./conf");
const cors = require("cors");
const bodyParser = require('body-parser')

const app = express();
app.use(cors({
    origin: "*"
}));
app.use(bodyParser.json())

app.get("/api/posts", (req, res) => {
    conn.query("select * from posts", (err, data) => {
        if (err) throw err;
        res.json({ data });
    });
});
app.get("/api/posts/:id", (req, res) => {
    const id = req.params.id;
    conn.query(`select * from posts where id = ${id} `, (err, data) => {
        if (err) throw err;
        res.json({ data });
    });
});
app.listen(4000, () => {
    console.log("serving");
});