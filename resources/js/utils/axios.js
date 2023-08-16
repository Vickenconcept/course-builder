import { Configuration, OpenAIApi } from "openai";

const configuration = new Configuration({
    apiKey: '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'
})

const openai = new OpenAIApi(configuration);

export async function getContent() {
    const { data } = await openai.createChatCompletion({
        model: 'gpt-3.5-turbo',
        messages: [
            {
                role: 'system',
                content: 'You are a knowledgeable assistant that provides detailed explanations about topics.'
            },
            {
                role: 'user',
                content: "explain composition api in a course content format, then take each of the course outlines and explain properly in an article format using images where necessary"
            }
        ]
    });

    console.log(data.choices);
}