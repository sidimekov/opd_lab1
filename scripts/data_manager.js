export const getData = async (url) => {

  const response = await fetch(url);

  if (!response.ok) {
    console.log(`Ошибка при получении данных, ${response.status}`);
  }

  return await response.json();

};

export const sendData = async (url, data) => {
  const response = await fetch(url, {
    method: 'POST',
    body: data,
  });

  if (!response.ok) {
    console.log(`Ошибка при посылке данных, ${response.status}`);
  }

  return await response.json();
}