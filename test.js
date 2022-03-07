const products = [
    {id:"MD34534",
        description:"Aspirina 100",
        type:"M",
        price:2500,
        stock:15,
        stockMin:10,
        dueDate: "2020/09/30"
    },
    {id:"LC3453",
        description:"Old Parr x 750",
        type:"L",
        price:89000,
        stock:69,
        stockMin:5,
        dueDate: "2019/10/11"
    },
    {id:"VI62674",
        description:"Arroz Casanare x 25",
        type:"V",
        price:42000,
        stock:54,
        stockMin:7,
        dueDate: "2020/12/15"
    },
    {id:"VI35367",
        description:"Leche en Polvo",
        type:"V",
        price:19800,
        stock:7,
        stockMin:5,
        dueDate: "2020/11/23"
    },
    {id:"LC84365",
        description:"Ron Boyaca",
        type:"L",
        price:32500,
        stock:31,
        stockMin:5,
        dueDate: "2020/06/12"
    },
    {id:"MD36573",
        description:"Dolex Jarabe",
        type:"M",
        price:4700,
        stock:20,
        stockMin:3,
        dueDate: "2020/05/17"
    }
]


products.forEach(product=>{
    console.log(product)
})