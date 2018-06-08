const vue = new Vue({
    el: '#confirm',
    data: {
        person: {},
        userFlg: false,
        emailFlg: false
    },
    methods: {
        /**
         * Método para verificação de usuário após mudanças 
         * do campo no html
         */
        verifyUser: async function()
        {
            const url = "http://localhost:8080/verifyuser?" + $.param({username: this.person.username})
            await fetch(url, {
                headers: {
                    'Authorization': 'ae6cc54b9627e70ba0b1c3b11655b9ad'
                },
                mode: 'cors'          
            })
            .then((response) => {
                if(response.ok)
                {
                    response.json().then((data) => {
                        if(data.result)
                        {
                            document.querySelector('#userAnswer').innerHTML = 'Este usuário já existe!'
                            this.userFlg = false
                        }
                        else if(this.person.username == '')
                        {
                            document.querySelector('#userAnswer').innerHTML = ''
                            this.userFlg = false
                        }
                        else
                        {
                            document.querySelector('#userAnswer').innerHTML = 'Tudo ok!'
                            this.userFlg = true
                        }
                    });
                }
                else
                {
                    console.log('The response ins\'t fetched!')
                }
            })
            .catch((error) => console.log('Request failed' + error))
        },

         /**
         * Método para verificação de email após mudanças 
         * do campo no html
         */
        verifyEmail: async function()
        {
            const verifyUsers = (email) =>
            {
                const compareExp = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/i;
                return compareExp.exec(email)
            }

            if(verifyUsers(this.person.email))
            {
                const url = "http://localhost:8080/verifyemail?" + $.param({email: this.person.email})
                await fetch(url, {
                    headers: {
                        'Authorization': 'ae6cc54b9627e70ba0b1c3b11655b9ad'
                    },
                    mode: 'cors'
                })
                .then((response) => {
                    if(response.ok)
                    {
                        response.json().then((data) => {
                            if(data.result)
                            {
                                document.querySelector('#emailAnswer').innerHTML = 'Este email já está cadastrado!'
                                this.emailFlg = false
                            }
                            else
                            {
                                document.querySelector('#emailAnswer').innerHTML = 'Tudo ok!'
                                this.emailFlg = true
                            }
                        });
                    }
                    else
                    {
                        console.log('The response ins\'t fetched!')
                    }
                })
                .catch((error) => console.log('Request failed' + error))
            }
            else if(this.person.email == '')
            {
                document.querySelector('#emailAnswer').innerHTML = ''
                this.emailFlg = false
            }
            else
            {
                document.querySelector('#emailAnswer').innerHTML = 'Email com formato incorreto!'
                this.emailFlg = false
            }
        },

        completeReg: async function()
        {
            if(this.userFlg === true && this.person.user != '' && this.emailFlg === true && this.person.email != '')
            { 
                const url = "http://localhost:8080/insertuser?" + $.param({
                    name: this.person.name,
                    lastname: this.person.lastname,
                    username: this.person.username,
                    email: this.person.email,
                    birthdate: this.person.birthdate,
                    password: this.person.password,
                    account: this.person.account
                })
                await fetch(url, {
                    headers: {
                        'Authorization': 'ae6cc54b9627e70ba0b1c3b11655b9ad'
                    },
                    mode: 'cors'          
                })
                .then((response) => {
                    if(response.ok)
                    {
                        response.json().then((data) => {
                            if(data.result)
                            {
                                document.querySelector('#insertResult').innerHTML = 'Usuário inserido com sucesso!'
                            }
                            else
                            {
                                document.querySelector('#insertResult').innerHTML = 'Não ok'
                            }
                        });
                    }
                    else
                    {
                        console.log('The response ins\'t fetched!')
                    }
                })
                .catch((error) => console.log('Request failed' + error))
            }
            else
            {
                document.querySelector('#insertResult').innerHTML = 'Complete os campos corretamente'
            }
        }
    }
})