import Token from "./Token";

class User {
    login(form) {
        axios
            .post("/api/auth/login", form)
            .then(res => {
                Token.payload(res.data.access_token);
            })
            .catch(err => console.log(err.response.data));
    }
}

export default User = new User();
