const express = require('express')
const bodyparser = require("body-parser")
const { default: mongoose } = require('mongoose')

const app = express()
const port = 3000

app.use(bodyparser.json())
app.use(express.static("public"))
app.use(bodyparser.urlencoded({
    extended:true
}))

mongoose.connect('mongodb://localhost:27017/mydb',{
    useNewUrlParser:true,
    useUnifiedTopology:true
});

const db = mongoose.connection;

db.on(`error`,()=>console.log("error"));
db.once(`open`,()=>console.log("successfully conn"))

app.post("/singup",(req,res)=>{
    var name = req.body.name;
    var email = req.body.email;
    var phone = req.body.phone;
    var password = req.body.password;

    var data = {
        "name" :name,
        "email":email,
        "phone":phone,
        "password":password
    }
    db.collection('users'),insertOne(data,(err,collection)=>{
        if(err){
            console.log("error");
        }
         console.log("successfully");
    });

    return res.redirect('signup_succ.html');
})

app.get('/', (req, res) =>{ res.set({
    "Allow-access-Allow-Origin": '*'
    })
    return res.redirect('index.html')  ;  
})

app.listen(port, () => console.log(`Example app listening on port ${port}!`))