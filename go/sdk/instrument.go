package sdk

import (
	"ais_sdk/src/core"
	"bytes"
	"crypto/tls"
	"encoding/json"
	"io/ioutil"
	"log"
	"net/http"
)

// post data by aksk
func InstrumentAksk(ak string, sk string, image string, url string, threshold float32) string {

	s := core.Signer{
		AppKey:    ak,
		AppSecret: sk,
	}

	requestBody := make(map[string]interface{})
	requestBody["image"] = image
	requestBody["url"] = url
	requestBody["threshold"] = threshold
	bytesData, err := json.Marshal(requestBody)

	if err != nil {
		return err.Error()
	}
	reader := bytes.NewBuffer(bytesData)

	uri := "https://" + core.IMAGE_ENDPOINT + core.INSTRUMENT
	r, _ := http.NewRequest("POST", uri, reader)

	r.Header.Add("content-type", "application/json")
	s.Sign(r)

	client := &http.Client{
		Transport: &http.Transport{
			TLSClientConfig: &tls.Config{InsecureSkipVerify: true},
		},
	}

	resp, err := client.Do(r)
	if err != nil {
		log.Println(err.Error())
	}

	defer resp.Body.Close()
	body, err := ioutil.ReadAll(resp.Body)
	if err != nil {
		log.Println(err.Error())
	}

	return string(body)

}
