export const getData = async (url) => {

  const response = await fetch(url);

  if (!response.ok) {
    console.log(`Ошибка при получении данных, ${response.status}`);
  }

  return await response.json();

};

// перед вызовом нужно JSON.stringify(data)
export const sendData = async (url, data) => {
  var response = await fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json;charset=utf-8'
    },
    body: data,
  });

  if (!response.ok) {
    console.log(`Ошибка при посылке данных, ${response.status}`);
  }

  return await response.json();
}

// обработка
// response = get/set...;
// response.then((data) => {console.log(data);})


// НАПРИМЕР
//const data = {
//   profId: profession_id,
//   expertId: expert_id
// };
// var response = sendData('../backend/get_ratings.php', JSON.stringify(data))
// .catch((err) => {
//   console.log(err);
// });

// response.then((data) => {console.log(data);});